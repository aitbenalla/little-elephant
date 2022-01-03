<?php

namespace App\Form;

use App\Controller\flash;
use App\Entity\Author;
use DOMException;
use stdClass;
class AuthorType extends FormType
{
    use flash;
    const email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
    const username_pattern = "/^[a-zA-Z0-9]{5,}$/";
    const pass_pattern = "/^.{8,}$/";
    const phone_pattern = "/^[0-9]{10}+$/";
    const full_name_pattern = "/^([a-zA-Z' ]+)$/";

    /**
     * @throws DOMException
     */
    public function buildForm(): stdClass
    {
        $builder = new stdClass();
        $media = new MediaAuthorType();

        $builder->photo = $media->buildForm()->name;
        $builder->full_name = $this->add('text','full_name', ['class'=>'form-control', 'required'=>true, 'label'=>'Full Name:']);
        $builder->username = $this->add('text','username', ['class'=>'form-control', 'required'=>true, 'label'=>'Username:']);
        $builder->birth_date = $this->add('date','birth_date', ['class'=>'form-control', 'required'=>true, 'label'=>'Birth Date:']);
        $builder->email = $this->add('text','email', ['class'=>'form-control', 'required'=>true, 'label'=>'Email:']);
        $builder->phone = $this->add('tel','phone', ['class'=>'form-control', 'required'=>true, 'label'=>'Phone:']);
        $builder->password = $this->add('password','password', ['class'=>'form-control', 'required'=>true, 'label'=>'Password:']);
        $builder->password_repeat = $this->add('password','password_repeat', ['class'=>'form-control', 'required'=>true, 'label'=>'Repeat Password:']);
        $builder->address = $this->add('text','address', ['class'=>'form-control', 'placeholder'=>'1234 Main St', 'label'=>'Address:']);
        $builder->city = $this->add('text','city', ['class'=>'form-control', 'label'=>'City:']);
        $builder->country = $this->add('select','country', ['class'=>'form-select','data'=>$this->getData(), 'label'=>'Country:']);

        return $builder;
    }

    public function submit($data): Author
    {
        $author = new Author();

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'full_name':
                    if (preg_match(self::full_name_pattern, $value)) {
                        $author->setFullName($value);
                    } else {
                        $this->message('Invalid name given.', 'danger', 'fl_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'birth_date':
                    if ($this->validateAge($value)) {
                        $author->setBirthDate($value);
                    } else {
                        $this->message('You Must be 18 or Older.', 'danger', 'bd_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'username':
                    if (preg_match(self::username_pattern, $value)) {
                        $author->setUsername($value);
                    } else {
                        $this->message('Invalid username.', 'danger', 'us_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'phone':
                    if (preg_match(self::phone_pattern, $value)) {
                        $author->setPhone(trim($value));
                    } else {
                        $this->message('Invalid phone number.', 'danger', 'ph_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'email':
                    // filter_var($value, FILTER_VALIDATE_EMAIL)
                    if (preg_match(self::email_pattern, $value)) {
                        $author->setEmail(trim($value));
                    } else {
                        $this->message('Invalid Email address.', 'danger', 'email_error');
                        header("Refresh:0");
                        exit;
                    }
                    break;
                case 'password':
                    if (preg_match(self::pass_pattern, $value)) {
                        if ($value === $_POST['password_repeat']) {
                            $author->setPassword($this->hashThePass($value));
                        } else {
                            $this->message('Passwords not match.', 'danger', 'ps_error');
                            header("Refresh:0");
                            exit;
                        }
                    } else {
                        $this->message('Password not strong enough / Password too short.', 'danger', 'ps_error2');
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

        return $author;
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

    private function getData(): array
    {
        return ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
    }
}