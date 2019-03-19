<?php
/**
 * Created by PhpStorm.
 * User: planetoid
 * Date: 2019-03-18
 * Time: 21:30
 */

namespace Summer;

class WikiData
{
    public function readFile($file_content = '', $separator = "\t"){
        $file_content = explode(PHP_EOL, $file_content);

        //var_dump($file_content);

        $field_list = $file_content[0];
        $field_list = explode($separator, $field_list);
        //var_dump($field_list);

        $output = array();

        $line_number = 1;
        foreach ($file_content AS $index => $row){
            if($line_number > 1){
                if(trim($row) !== ''){
                    $line_content = explode($separator, $row);
                    $output[] = 'CREATE';

                    foreach ($field_list AS $field_number => $field_name){

                        $field_name = trim($field_name);

                        $field_value = $line_content[$field_number];
                        $field_value = trim($field_value);


                        //var_dump($field_value);
                        preg_match('/^([^a-zA-Z0-9]+)$/iu', $field_value, $matches);
                        //var_dump($matches);
                        if(isset($matches[1])){
                            $output[] = 'LAST' . $separator . $field_name . $separator . '"' . $field_value . '"';
                        }else{
                            $output[] = 'LAST' . $separator . $field_name . $separator . $field_value;
                        }

                    }
                }

            }
            $line_number++;
        }

        return implode(PHP_EOL, $output);
    }
}