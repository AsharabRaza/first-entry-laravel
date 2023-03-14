<?php

use App\Models\Entry;
use App\Models\User;
use App\Models\Lottery;
use Illuminate\Support\Facades\DB;
use Postmark\PostmarkClient;

function formatted_date($date, $format = 'M d, Y h:i a') {
    $formatted_Date = date($format, strtotime($date));
    return $formatted_Date;
}

function getRemainingUserEvents($userId)
{
    $lottery = new Lottery();
    $eventsCreated = $lottery->getEventsCountByUserId($userId);

    $user = User::find($userId);
    if (!empty($user)) {
        $remainingEvents = $user->event_limit - $eventsCreated;
        if ($remainingEvents > 0) {
            return true;
        }
    }
    return false;
}

function getMemberShipInfo($userId)
{
    $row1 = DB::table('memberships')->where('user_id', $userId)->first();
    if (!empty($row1)) {
        $memberShipId = $row1->membership_id;
        $row = DB::table('memberships_infos')->where('id', $memberShipId)->first();
        if (!empty($row)) {
            $array = [
                "total_months" => $row1->total_months,
                "expire_date_time" => $row1->expire_date_time,
                "payment_method" => $row1->payment_method,
                "membership_type" => $row->membership_type,
                "cost" => $row->cost,
                "monthly" => $row->monthly,
                "yearly_monthly" => $row->yearly_monthly,
                "total_yearly" => $row->total_yearly,
                "manage_event" => $row->manage_event,
                "events" => $row->events,
                "event_analytics" => $row->event_analytics,
                "embed_form_link" => $row->embed_form_link,
                "customize_online_forms" => $row->customize_online_forms,
                "custom_field" => $row->custom_field,
                "amount_of_entries" => $row->amount_of_entries,
                "amount_of_emails" => $row->amount_of_emails,
                "emails_analytics" => $row->emails_analytics,
                "first_entry_uid" => $row->first_entry_uid,
                "qr_scanning" => $row->qr_scanning,
                "barcode_scanning" => $row->barcode_scanning,
                "addons" => $row->addons,
                "sms_notification" => $row->sms_notification,
                "last_updated" => $row->last_updated,
                "date_created" => $row->date_created,
            ];
            return $array;
            //return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function expireStatus($userId)
{
    $expireRow = DB::table('memberships')
        ->where('user_id', $userId)
        ->first();
    $numRows = DB::table('memberships')
        ->where('user_id', $userId)
        ->count();
    //$userType = $expireRow->user_type ?? null;
    $user = User::find($userId);
    $userType = $user->user_type;

    if($userType === 1){

        $membershipInfo = getMemberShipInfo($userId);

        if ($numRows === 0) {
            //return if user have no any subscription.
            return ['status'=>false,'subscription'=>false];
        } else {
            $expire = $expireRow->expire_date_time;
            $date = date("Y-m-d h:i:s");

            if ($expire < $date) {
                //return if user subscription expired.
                return ['status'=>false,'expire'=>true];

            //}elseif ($membershipInfo == false){
            }elseif (!$membershipInfo){
                //return if subscribed package/event no more exist or deleted.
                return ['status'=>false,'subscription'=>false];
            }
            else {
                return ['status'=>true];
            }
        }
    }

}

function getCountriesNames($country_code = '', $search_country = false){
    $countries =
        array(
            "0" => "Select Country",
            "AF" => "Afghanistan",
            "AX" => "Aland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, The Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and The South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.S.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabw"
        );

    if($search_country)
        return (isset($countries[$country_code]) ? $countries[$country_code] : '');
    return $countries;
}

function convert_timezone($datetime, $from_tz, $to_tz, $format = 'M d, Y h:i a') {
    if(empty($datetime)) {
        return null;
    }

    $to_tz = empty($to_tz) ? config('app.timezone') : $to_tz;
    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i', $datetime, $from_tz)->setTimezone($to_tz);
//    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime, $from_tz)->setTimezone($to_tz);
    return $date->format($format);
}

function convert_timezone_new($datetime, $from_tz, $to_tz, $format = 'M d, Y h:i a') {
    if(empty($datetime)) {
        return null;
    }

    $to_tz = empty($to_tz) ? config('app.timezone') : $to_tz;
    $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime, $from_tz)->setTimezone($to_tz);
    return $date->format($format);
}

function getTimeZone($country_code = '') {
    $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country_code);
    return $timezones;
}

function generateUniqueUID($length){
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $my_string = '';
    for ($i = 0; $i < $length; $i++) {
        $pos = mt_rand(0, strlen($chars) -1);
        $my_string .= substr($chars, $pos, 1);
    }
    $entry = Entry::where('uid', $my_string)->first();

    if($entry != null){
        return generateUniqueUID($length);
    } else{
        return $my_string;
    }
}

function send_email_batch_with_template($batch){

    $batches_chunk = array_chunk($batch, 500);
    $client = new PostmarkClient('e22698e7-1778-41ea-bddc-c4442310a7b3');
    foreach($batches_chunk as $batch_) {
        $response = $client->sendEmailBatchWithTemplate($batch_);
    }

    return $response;
}















































