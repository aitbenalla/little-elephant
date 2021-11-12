<?php 
require 'connection.php';

if (isset($_POST['add_row']))
{
    $email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    $username_pattern = '/^[a-zA-Z0-9]{5,}$/';
    $pass_pattern = '/^.{8,}$/';
    $phone_pattern = '[0-9]{3}-[0-9]{2}-[0-9]{3}';

    foreach ($_POST as $key => $value) {
        switch ($key)
        {
            case 'birthday':
                if (validateAge($value))
                {
                    $birth = $value;
                }
                else
                {
                    getAlert('error','new-member.php','Birthday Invalid');
                }
                break;
            case 'username':
                if(preg_match($username_pattern, $value))
                {
                    $username = $value;
                }
                else
                {
                    getAlert('error','new-member.php','Username Invalid');
                }
                break;
            case 'phone':
                $phone = trim($value);
                break;
            case 'email':
                if(preg_match($email_pattern, $value))
                {
                    $email = trim($value);
                }
                else {
                    getAlert('error','new-member.php','Email Invalid');
                }
                break;
            case 'password':
                if (preg_match($pass_pattern, $value)) {
                    $password = hashThePass($value);
                }
                else
                {
                    getAlert('error','new-member.php','Password not strong enough / Password too short!');
                }
            case 'address':
                $address = $value;
                break;
            case 'city':
                $city = trim($value);
                break;
            case 'country':
                $country = $value;
                break;
            case 'zip':
                $zip = $value;
                break;
            default:
                break;
        }
    }

    $sql = 'INSERT INTO members(birthday,username,phone,email,password,city,country,zip) 
    VALUES(
        :birthday,
        :username,
        :phone,
        :email,
        :password,
        :city,
        :country,
        :zip
        )';

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(":birthday", $birth);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $pass);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":country", $country);
    $stmt->bindParam(":zip", $zip);

    $stmt->execute();

    $member_id = $connection->lastInsertId();

    echo 'The publisher id ' . $member_id . ' was inserted';

}

function validateAge($date, $age = 18)
{
    $birthday = date("d-m-Y", strtotime($date));  

    // $birthday can be UNIX_TIMESTAMP or just a string-date.
    if(is_string($birthday)) {
        $birthday = strtotime($birthday);
    }

    // check
    // 31536000 is the number of seconds in a 365 days year.
    if(time() - $birthday < $age * 31536000)  {
        return false;
    }

    return true;
}

function hashThePass($pass)
{
    $options = [
        'cost' => 12,
    ];
    return password_hash($pass, PASSWORD_BCRYPT, $options);
}
