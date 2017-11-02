<?php
/**
 * Created by PhpStorm.
 * User: Zobair
 * Date: 14-12-2016
 * Time: 01:00
 */

$projectConfig =
    [
        "ProjectRoot" => "/cpox",
        "AppName" => " ",
        "Version" => " ",
        "Domain" => " ",
    ];

$relativePath = $_SERVER['DOCUMENT_ROOT']. $projectConfig['ProjectRoot'];

$config =
    [
        "Path" => [
            "App" => $relativePath . "src/app/",
            "Templates" => $relativePath . "/src/app/views/",
            "Controllers" => $relativePath . "/src/app/controllers/",
            "Models" => $relativePath . "/src/app/models/",
            "Lib" => $relativePath . "/lib/",
            "Plates" => $relativePath . "/lib/plates-3.1.1/",
            "Src" => $relativePath . "/src/",
            "PlatesSrc" => $relativePath . "/lib/plates-3.1.1/src/",
            "PlatesTemplate" => $relativePath . "/lib/plates-3.1.1/src/Template/",
            "PlatesExtension" => $relativePath . "/lib/plates-3.1.1/src/Extension/",
        ],

        "Databases" => [
            "MainDatabase" =>
                [
                    "DatabaseType" => "mysql",
                    "Host" => "127.0.0.1",
                    "DatabaseName" => "users",
                    "Username" => "root",
                    "Password" => ""
                ],

            "SecondaryDatabase" =>
                [
                    "DatabaseType" => " ",
                    "Host" => " ",
                    "DatabaseName" => " ",
                    "Username" => " ",
                    "Password" => " "
                ],

            "OptionalDatabase" =>
                [
                    "DatabaseType" => " ",
                    "Host" => " ",
                    "DatabaseName" => " ",
                    "Username" => " ",
                    "Password" => " "
                ]
        ]
    ];

