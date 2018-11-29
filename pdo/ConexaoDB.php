<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 21/11/2018
 * Time: 10:36
 */

final class ConexaoDB
{

    private static $conn = null;

    private function __construct(){}

    public static function getInstance(){
        if(self::$conn == null){
            try{
                self::$conn = new PDO('pgsql:dbname=trabalho; user=postgres; password=121295rs; host=localhost');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                print_r(self::$conn);
            }catch (PDOException $exception){
                echo $exception->getMessage();
            }

            return self::$conn;
        }

        return self::$conn;
    }

    public static function close(){
        self::$conn = null;
        echo "\nLiberou os recursos.";
    }
}