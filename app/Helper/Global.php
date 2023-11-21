<?php

function help_hapus_spesial_karakter($request_form_input)
{
    // $remove = array("@", "#", "(", ")", "*", "/", "'", "`");
    $hapus  = preg_replace('/[^A-Za-z0-9-_\-]/', ' ', $request_form_input);
    return $hapus;
}

function help_tanggal_jam($data)
{
    return \Carbon\Carbon::parse($data)
        ->isoFormat('dddd, D MMMM Y, H:mm');
}

// function help_hapus_spesial_karakter($request_form_input)
// {

//     $t = $request_form_input;

//     $specChars = array(
//         '!' => '%21',       '"' => '%22',
//         '#' => '%23',       '$' => '%24',    '%' => '%25',
//         '&' => '%26',       '\'' => '%27',   '(' => '%28',
//         ')' => '%29',       '*' => '%2A',    '+' => '%2B',
//         ',' => '%2C',       '-' => '%2D',    '.' => '%2E',
//         '/' => '%2F',       ':' => '%3A',    ';' => '%3B',
//         '<' => '%3C',       '=' => '%3D',    '>' => '%3E',
//         '?' => '%3F',       '@' => '%40',    '[' => '%5B',
//         '\\' => '%5C',      ']' => '%5D',    '^' => '%5E',
//         '_' => '%5F',       '`' => '%60',    '{' => '%7B',
//         '|' => '%7C',       '}' => '%7D',    '~' => '%7E',
//         ',' => '%E2%80%9A'
//     );

//     foreach ($specChars as $k => $v) {
//         $hapus = str_replace($k, $v, $t);
//     }

//     return $hapus;
// }
