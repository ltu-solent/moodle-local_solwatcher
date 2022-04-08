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
 * Observer class
 *
 * @package   local_solwatcher
 * @author    Mark Sharp <mark.sharp@solent.ac.uk>
 * @copyright 2022 Solent University {@link https://www.solent.ac.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_solwatcher;

use local_solwatcher\local\check_assign;

class observers {
    public static function cm_updated(\core\event\course_module_updated $event) {
        global $DB;
        $eventdata = $event->get_data();

        $coursemodule = $DB->get_record('course_modules', ['id' => $event->objectid]);
        $coursemodulename = $DB->get_field('modules', 'name', ['id' => $coursemodule->module]);

        if ($coursemodulename == 'assign') {
            check_assign::check_visibility($coursemodule);
        }
    }
}