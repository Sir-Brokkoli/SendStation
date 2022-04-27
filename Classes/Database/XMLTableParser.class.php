<?php namespace Sendstation\Database;

final class XMLTableParser {

    private function __construct() { /*Static class */ }
    private function __clone() { /*Static class */ }

    public static function parseEntityInitialization($xml) :string {

        $attributeDeclaration = "";
        $keyDeclaration = "";

        // Deal with primary key
        $compoundKey = $xml->key->children();
        if ($compoundKey == null) {

            $key = $xml->key;
            $attributeDeclaration .= "{$key} {$key['type']} PRIMARY KEY,";
        }
        else {

            $keyDeclaration .= "PRIMARY KEY (";
            foreach ($compoundKey as $key) {

                $attributeDeclaration .= "{$key} {$key['type']},";
                $keyDeclaration .= "{$key},";
            }

            $keyDeclaration = \substr_replace($keyDeclaration, "),", -1);
        }

        // Deal with foreign keys
        foreach ($xml->foreign as $foreignKey) {

            $compoundKey = $foreignKey->children();
            if ($compoundKey == null) {

                $attributeDeclaration .= "{$foreignKey} {$foreignKey['type']} REFERENCING {$foreignKey['ref']},";
            }
            else {

                $keyDeclaration .= "FOREIGN KEY (";
                foreach ($compoundKey as $keyPart) {

                    $attributeDeclaration .= "{$keyPart} {$keyPart['type']},";
                    $keyDeclaration .= "{$keyPart},";
                }

                $keyDeclaration = \substr_replace($keyDeclaration, ") ", -1);
                $keyDeclaration .= "REFERENCING {$foreignKey['ref']},";
            }
        }

        // Deal with attributes
        foreach ($xml->attr as $attr) {

            $attributeDeclaration .= "{$attr} {$attr['type']}, ";
        }

        return substr($attributeDeclaration . $keyDeclaration, 0, -1);
    }
}

?>