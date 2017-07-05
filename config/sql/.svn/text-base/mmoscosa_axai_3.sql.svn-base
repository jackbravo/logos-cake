ALTER TABLE parts ADD COLUMN first_code INT(11);
-- select the first entries.id from each part of the MUV family
CREATE TEMPORARY TABLE muv_first_entries SELECT entries.id, part_id FROM parts LEFT JOIN entries ON parts.id = entries.part_id WHERE family_id = 1 GROUP BY part_id ORDER BY entries.id;
UPDATE parts, muv_first_entries AS muv SET parts.first_code = muv.id WHERE parts.id = muv.part_id;
DROP TABLE muv_first_entries;
