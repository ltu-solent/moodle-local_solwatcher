<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Check Assignment for changes
 *
 * @package   local_solwatcher
 * @author    Mark Sharp <mark.sharp@solent.ac.uk>
 * @copyright 2022 Solent University {@link https://www.solent.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_solwatcher\local;

class check_assign {
    public static function check_visibility($coursemodule) {
        global $DB;
        if ($coursemodule->idnumber == '') {
            return;
        }
        if ($coursemodule->visible == 1) {
            return;
        }
        $sitting = $DB->get_record('local_quercus_tasks_sittings', [
            'assign' => $coursemodule->instance
        ]);
        if (!$sitting) {
            return;
        }
        if ($sitting->sitting_desc == 'FIRST_SITTING') {
            $coursemodule->visible = 1;
            $DB->update_record('course_modules', $coursemodule);
        }
    }
}