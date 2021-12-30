<?php

namespace App\Model;

use App\Entity\Author;
use PDO;
use PDOException;
class AuthorRepository extends Database
{
    const email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const username_pattern = "/^[a-zA-Z0-9]{5,}$/";
    const pass_pattern = "/^.{8,}$/";
    const phone_pattern = "/^[0-9]{10}+$/";
    const full_name_pattern = "/^([a-zA-Z' ]+)$/";

    public function getAll(): bool|array|string
    {
        try {
            $sql = 'SELECT author.*, media_author.name, media_author.type
                    FROM author
                    LEFT JOIN media_author ON author.id = media_author.author_id';
            return $this->getConnection()->query($sql)->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function getOneByUsername(string $username)
    {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare('SELECT author.*, media_author.name, media_author.type FROM author LEFT JOIN media_author ON author.id = media_author.author_id WHERE username=? LIMIT 1');

            $stmt->execute([$username]);
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function getOneById(int $id)
    {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare('SELECT author.*, media_author.name, media_author.type FROM author LEFT JOIN media_author ON author.id = media_author.author_id WHERE id=? LIMIT 1');

            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function persist()
    {
        $author = new Author();
        foreach ($_POST as $key => $value) {
            switch ($key) {
                case 'full_name':
                    if (preg_match(self::full_name_pattern, $value)) {
                        $author->setFullName($value);
                    } else {
                        $this->flash('Invalid name given.', 'danger', 'fl_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'birth_date':
                    if ($this->validateAge($value)) {
                        $author->setBirthDate($value);
                    } else {
                        $this->flash('You Must be 18 or Older.', 'danger', 'bd_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'username':
                    if (preg_match(self::username_pattern, $value)) {
                        $author->setUsername($value);
                    } else {
                        $this->flash('Invalid username.', 'danger', 'us_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'phone':
                    if (preg_match(self::phone_pattern, $value)) {
                        $author->setPhone(trim($value));
                    } else {
                        $this->flash('Invalid phone number.', 'danger', 'ph_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'email':
                    // filter_var($value, FILTER_VALIDATE_EMAIL)
                    if (preg_match(self::email_pattern, $value)) {
                        $author->setEmail(trim($value));
                    } else {
                        $this->flash('Invalid Email address.', 'danger', 'email_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'password':
                    if (preg_match(self::pass_pattern, $value)) {
                        if ($value === $_POST['password_repeat']) {
                            $author->setPassword($this->hashThePass($value));
                        } else {
                            $this->flash('Passwords not match.', 'danger', 'ps_error');
                            header("Refresh:0");
                            exit;
                        }
                    } else {
                        $this->flash('Password not strong enough / Password too short.', 'danger', 'ps_error2');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'address':
                    $author->setAddress($value);
                    break;
                case 'city':
                    $author->setCity(trim($value));
                    break;
                case 'country':
                    $author->setCountry(trim($value));
                    break;
                case 'zip':
                    $author->setZip(trim($value));
                    break;
                default:
                    break;
            }
        }
    }

    public function flush(Author $author): bool|int|string|null
    {
        try {
            $sql = 'INSERT INTO author(full_name,birth_date,username,phone,email,password,address,city,country,created_at) 
                    VALUES(
                        :full_name,
                        :birth_date,
                        :username,
                        :phone,
                        :email,
                        :password,
                        :address,
                        :city,
                        :country,
                        :created_at
                        )';

            if ($author->getId()) {
                $sql = 'UPDATE author SET 
                        full_name = :full_name,
                        birth_date = :birth_date,
                        username = :username,
                        phone = :phone,
                        email = :email,
                        password = :password,
                        address = :address,
                        city = :city,
                        country = :country,
                        updated_at = :updated_at
                        WHERE id = :id
                        ';
            }

            $conn = $this->getConnection();
            $stmt = $conn->prepare($sql);

            if ($author->getId()) {
                $stmt->bindValue(":id", $author->getId());
                $stmt->bindValue(":updated_at", $author->getUpdatedAt()->format('Y-m-d H:i:s'));
            }
            $stmt->bindValue(":full_name", $author->getFullName());
            $stmt->bindValue(":birth_date", $author->getBirthDate());
            $stmt->bindValue(":username", $author->getUsername());
            $stmt->bindValue(":phone", $author->getPhone());
            $stmt->bindValue(":email", $author->getEmail());
            $stmt->bindValue(":password", $author->getPassword());
            $stmt->bindValue(":address", $author->getAddress());
            $stmt->bindValue(":city", $author->getCity());
            $stmt->bindValue(":country", $author->getCountry());
            if ($author->getCreatedAt())
            {
                $stmt->bindValue(":created_at", $author->getCreatedAt()->format('Y-m-d H:i:s'));
            }

            $stmt->execute();

            $author_id = $conn->lastInsertId();

            if ($author->getId()) {
                return $author->getId();
            }

            return $author_id;
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }

    }

    public function delete(int $id): bool
    {
        try {
            $stmt = $this->getConnection()->prepare( "DELETE FROM author WHERE id=:id" );
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }

    public function getAuth($email)
    {
        try {
            $conn = $this->getConnection();

            $stmt = $conn->prepare('SELECT author.*, media_author.name, media_author.type FROM author LEFT JOIN media_author ON author.id = media_author.author_id WHERE email = ?');
            $stmt->execute([$email]);

            $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Author::class);

            return $stmt->fetch();
        }
        catch (PDOException $th)
        {
            return $th->getMessage();
        }
    }

    private function validateAge($date): bool
    {
        $age = 18;
        $birthday = date("d-m-Y", strtotime($date));

        // $birthday can be UNIX_TIMESTAMP or just a string-date.
        if (is_string($birthday)) {
            $birthday = strtotime($birthday);
        }

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if (time() - $birthday < $age * 31536000) {
            return false;
        }

        return true;
    }

    private function hashThePass($pass): string
    {
        $options = [
            'cost' => 12,
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
}
