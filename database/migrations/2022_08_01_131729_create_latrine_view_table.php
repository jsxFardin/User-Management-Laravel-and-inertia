<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement($this->dropView());
    }

    private function dropView(): string
    {
    return <<<SQL
    DROP VIEW IF EXISTS `latrine_with_desludges_reports`;
    SQL;
    }

    private function createView(): string
    {
    return <<<SQL
    CREATE VIEW `latrine_with_desludges_reports` AS
    SELECT
        `lt`.*, `cmp`.`name` AS `camp_name`, `blk`.`short_name` AS `block_name`, `sblk`.`short_name` AS `sub_block_name`, `ft`.`name` AS `facility_type_name`, `fu`.`name` AS `facility_used_name`, `cns`.`name` AS `construction_status_name`, `lst`.`name` AS `latrine_structure_name`, `pt`.`name` AS `pit_type_name`, `dnr`.`name` AS `donor_name`,
        MAX(DATE(des.collection_date)) AS last_desludge_date,
        DATE_ADD(MAX(DATE(des.collection_date)), INTERVAL FLOOR(TIMESTAMPDIFF(DAY, min(des.collection_date), max(des.collection_date) ) / (count(*) - 1)) DAY) AS next_desludge_date
    FROM `latrines` as `lt`
    INNER JOIN `camps` as `cmp` on `lt`.`camp_id` = `cmp`.`id`
    INNER JOIN `blocks` as `blk` on `lt`.`block_id` = `blk`.`id`
    LEFT JOIN `blocks` as `sblk` on `lt`.`sub_block_id` = `sblk`.`id`
    INNER JOIN `facility_types` as `ft` on `lt`.`facility_type_id` = `ft`.`id`
    INNER JOIN `facility_useds` as `fu` on `lt`.`facility_used_id` = `fu`.`id`
    INNER JOIN `construction_status` as `cns` on `lt`.`construction_status_id` = `cns`.`id`
    INNER JOIN `latrine_structures` as `lst` on `lt`.`latrine_structure_id` = `lst`.`id`
    INNER JOIN `pit_types` as `pt` on `lt`.`pit_type_id` = `pt`.`id`
    LEFT JOIN `donors` as `dnr` on `lt`.`constructor_id` = `dnr`.`id`
    LEFT JOIN `desludges` as `des` on `des`.`latrine_id` = `lt`.`id` AND FIND_IN_SET(UPPER(monthname(collection_date)), (
        SELECT * FROM
        (
            SELECT months
            FROM seasons
            WHERE FIND_IN_SET(upper(DATE_FORMAT(CURRENT_DATE(), '%M')), months) > 0
        ) AS subquery
    )) > 0
    group by `lt`.`id`
    SQL;
    }
};
