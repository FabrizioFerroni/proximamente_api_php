<?php
require_once('environments/conexion.php');

class GetModel
{
    static public function getData($select, $table, $orderBy, $orderMode, $startAt, $endAt)
    {

        if (empty(Connection::getColumnsData($table))) {
            return null;
        }

        // Sin ordenar y limitar datos
        $sql = "SELECT $select FROM $table";

        // Ordenar sin limitar datos
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getDataFilter($select, $table, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt)
    {
        if (empty(Connection::getColumnsData($table))) {
            return null;
        }

        $filtertoArray = explode(',', $filter);
        $filterTotoArray = explode('_', $filterTo);
        $filtertoText = "";
        if (count($filtertoArray) > 1) {
            foreach ($filtertoArray as $key => $value) {
                if ($key > 0) {
                    $filtertoText .= " AND " . $value . " = :" . $value . " ";
                }
            }
        }

        // Sin ordenar y limitar datos con filtros
        $sql = "SELECT $select FROM $table WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText";

        // Ordenar sin limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT  $select FROM $table WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT  $select FROM $table WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos con filtros
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT  $select FROM $table WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($filtertoArray as $key => $value) {
            $stmt->bindParam(":" . $value, $filterTotoArray[$key], PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRelData($select, $rel, $type, $orderBy, $orderMode, $startAt, $endAt)
    {
        $relArray = explode(",", $rel);
        $typeArray = explode(',', $type);
        $innerJoinText = "";
        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {

                if (empty(Connection::getColumnsData($value))) {
                    return null;
                }

                if ($key > 0) {
                    // $innerJoinText .= "INNER JOIN ". $value . " ON ". $relArray[0] . " " . $typeArray[$key]. "_id = ". $value . " " . $typeArray[$key] . "_id ";
                    $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[$key] . "_id = " . $value . ".id ";
                }
            }
        }

        // Sin ordenar y limitar datos
        $sql = "SELECT $select FROM $relArray[0] $innerJoinText";

        // Ordenar sin limitar datos
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRelDataFilter($select, $rel, $type, $filter, $filterTo, $orderBy, $orderMode, $startAt, $endAt)
    {
        $relArray = explode(",", $rel);
        $typeArray = explode(',', $type);
        $innerJoinText = "";
        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {
                if (empty(Connection::getColumnsData($value))) {
                    return null;
                }

                if ($key > 0) {
                    // $innerJoinText .= "INNER JOIN ". $value . " ON ". $relArray[0] . " " . $typeArray[$key]. "_id = ". $value . " " . $typeArray[$key] . "_id ";
                    $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[$key] . "_id = " . $value . ".id ";
                }
            }
        }

        $filtertoArray = explode(',', $filter);
        $filterTotoArray = explode('_', $filterTo);
        $filtertoText = "";
        if (count($filtertoArray) > 1) {
            foreach ($filtertoArray as $key => $value) {
                if ($key > 0) {
                    $filtertoText .= " AND " . $value . " = :" . $value . " ";
                }
            }
        }

        // Sin ordenar y limitar datos con filtros
        $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText";

        // Ordenar sin limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos con filtros
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] = :$filtertoArray[0] $filtertoText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($filtertoArray as $key => $value) {
            $stmt->bindParam(":" . $value, $filterTotoArray[$key], PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getDataSearch($select, $table, $filter, $search, $orderBy, $orderMode, $startAt, $endAt)
    {
        if (empty(Connection::getColumnsData($table))) {
            return null;
        }

        $filtertoArray = explode(',', $filter);
        $searchtoArray = explode('_', $search);
        $filtertoText = "";
        if (count($filtertoArray) > 1) {
            foreach ($filtertoArray as $key => $value) {
                if ($key > 0) {
                    $filtertoText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }
        // Sin ordenar y limitar datos
        $sql = "SELECT $select FROM $table WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText";

        // Ordenar sin limitar datos
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($filtertoArray as $key => $value) {
            if ($key > 0) {
                $stmt->bindParam(":" . $value, $searchtoArray[$key], PDO::PARAM_STR);
            }
        }

        // return;
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRelDataSearch($select, $rel, $type, $filter, $search, $orderBy, $orderMode, $startAt, $endAt)
    {

        $filtertoArray = explode(',', $filter);
        $searchtoArray = explode('_', $search);
        $filtertoText = "";
        if (count($filtertoArray) > 1) {
            foreach ($filtertoArray as $key => $value) {
                if ($key > 0) {
                    $filtertoText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(',', $type);
        $innerJoinText = "";
        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {
                if (empty(Connection::getColumnsData($value))) {
                    return null;
                }

                if ($key > 0) {
                    // $innerJoinText .= "INNER JOIN ". $value . " ON ". $relArray[0] . " " . $typeArray[$key]. "_id = ". $value . " " . $typeArray[$key] . "_id ";
                    $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[$key] . "_id = " . $value . ".id ";
                }
            }
        }

        $filtertoArray = explode(',', $filter);
        $filterTotoArray = explode('_', $search);
        $filtertoText = "";
        if (count($filtertoArray) > 1) {
            foreach ($filtertoArray as $key => $value) {
                if ($key > 0) {
                    $filtertoText .= " AND " . $value . " = :" . $value . " ";
                }
            }
        }

        // Sin ordenar y limitar datos con filtros
        $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText";

        // Ordenar sin limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos con filtros
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos con filtros
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filtertoArray[0] LIKE '%$searchtoArray[0]%' $filtertoText LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($filtertoArray as $key => $value) {
            if ($key > 0) {
                $stmt->bindParam(":" . $value, $searchtoArray[$key], PDO::PARAM_STR);
            }
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRange($select, $table, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR)
    {

        if (empty(Connection::getColumnsData($table))) {
            return null;
        }

        $filtersql = "";
        if ($filtertoR != null && $intoR != null) {
            $filtersql = 'AND ' . $filtertoR . ' IN (' . $intoR . ') ';
        }
        $sql = "SELECT $select FROM $table WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql";

        // Ordenar sin limitar datos
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql ORDER BY $orderBy $orderMode";
        }

        // Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
        }

        // Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql LIMIT $startAt, $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function getRangeRel($select, $rel, $type, $filter, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filtertoR, $intoR)
    {
        $filtersql = "";
        if ($filtertoR != null && $intoR != null) {
            $filtersql = 'AND ' . $filtertoR . ' IN (' . $intoR . ') ';
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(',', $type);
        $innerJoinText = "";
        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {

                if (empty(Connection::getColumnsData($value))) {
                    return null;
                }
                
                if ($key > 0) {
                    // $innerJoinText .= "INNER JOIN ". $value . " ON ". $relArray[0] . " " . $typeArray[$key]. "_id = ". $value . " " . $typeArray[$key] . "_id ";
                    $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[$key] . "_id = " . $value . ".id ";
                }
            }

            $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql";

            // Ordenar sin limitar datos
            if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql ORDER BY $orderBy $orderMode";
            }

            // Ordenar y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
            }

            // Limitar sin ordenar datos
            if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $filter BETWEEN '$between1' AND '$between2' $filtersql LIMIT $startAt, $endAt";
            }

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } else {
            return null;
        }
    }
}
