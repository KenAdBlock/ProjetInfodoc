<?php
    // fichier UtilBackOffice.php
    //
    // Utilitaires du BackOffice
    // 
    //   

$TabTypesInt        = array  ("BIGINT", "DEC", "DECIMAL", "INT", "INTEGER",
                              "MEDIUMINT", "NUMERIC", "SMALLINT", "TINYINT"); 
$TabTypesReal       = array  ("DOUBLE PRECISION", "FLOAT", "REAL");
$TabTypesString     = array  ("BLOB", "CHAR", "ENUM", "LONGBLOB", 
                              "MEDIUMBLOB", "MEDIUMTEXT", "SET", "STRING", "TEXT",
                              "TINYBLOB","TINYTEXT", "VARCHAR");
$TabTypesBigString  = array  ("BLOB", "LONGBLOB", 
                              "MEDIUMBLOB", "MEDIUMTEXT", "TEXT",
                              "TINYBLOB","TINYTEXT");

function IsTypeInt ($Type)
{
    global $TabTypesInt;
    return in_array (strtoupper ($Type), $TabTypesInt);

} // IsTypeInt()

function IsTypeDate ($Type)
{
    return strtoupper ($Type) == 'DATE';

} // IsTypeDate()

function IsTypeReal ($Type)
{
    global $TabTypesReal;
    return in_array (strtoupper ($Type), $TabTypesReal);

} // IsTypeReal()

function IsTypeNum ($Type)
{
    return IsTypeInt ($Type) || IsTypeReal ($Type);

} // IsTypeNum()

function IsTypeBigString ($Type)
{
    global $TabTypesBigString;
    return in_array (strtoupper ($Type), $TabTypesBigString);

} // IsTypeBigString()

function IsTypeString ($Type)
{
    global $TabTypesString;
    return in_array (strtoupper ($Type), $TabTypesString);

} // IsTypeString()

function IsTypeFK ($Ident)
{
    return substr ($Ident, 0, 3) == 'FK_';

} // IsTypeFK()

function IsTypePK ($Ident)
{
    return substr ($Ident, 0, 3) == 'PK_';

} // IsTypePK()

function IsTypeBool ($Ident)
{
    return substr ($Ident, 0, 3) == 'Is_';

} // IsTypeBool()

?>
