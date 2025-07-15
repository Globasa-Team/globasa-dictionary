<?php

namespace WorldlangDict;

use Exception;

class Changelog {

    
    public static function new_terms(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        $q = $db->prepare("SELECT `term`, `timestamp` FROM {$config->db_prefix}term_log
            WHERE `type`='term added'
            ORDER BY `timestamp` DESC LIMIT 300;");
        $q->execute();
        $result = $q->fetchAll();
        if (!$result) throw new Exception("SQL Error");

        return $result;
    }

    private static function query(WorldlangDictConfig $config, string $columns='*', ?string $type=null, int $limit=300) : array {

        $q_where = "";
        if ($type) $q_where = "where type = :type";

        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        $q = $db->prepare("SELECT {$columns} FROM {$config->db_prefix}term_log
            {$q_where}
            ORDER BY `timestamp` DESC LIMIT :limit ;");

        $q->bindValue('limit', $limit, \PDO::PARAM_INT);
        if ($type) $q->bindValue('type', $type, \PDO::PARAM_STR);
        $q->execute();
        $result = $q->fetchAll();
        if (!$result) throw new Exception("SQL Error");

        return $result;
    }

    public static function recent_changes(WorldlangDictConfig $config) : array {
        return self::query(config:$config);
    }

    
    public static function removed_terms(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        $q = $db->prepare("SELECT `term`, `timestamp`, `message` FROM {$config->db_prefix}term_log
            WHERE `type` IN ('term removed','term renamed')
            ORDER BY `timestamp` DESC LIMIT 300;");
        $q->execute();
        $result = $q->fetchAll();
        if (!$result) throw new Exception("SQL Error");

        return $result;
    }

    
    public static function updated_entries(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        $q = $db->prepare("SELECT `term`, max(`timestamp`) as `timestamp` FROM {$config->db_prefix}term_log
            WHERE `type` IN ('field updated','field removed','field added')
            GROUP BY term
            ORDER BY `timestamp` DESC LIMIT 300;");
        $q->execute();
        $result = $q->fetchAll();
        if (!$result) throw new Exception("SQL Error");

        return $result;
    }
}