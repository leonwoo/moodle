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
 * Event for when log report is viewed.
 *
 * @package    report_log
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace report_log\event;

/**
 * Event triggered, when log report is viewed.
 *
 * @property-read array $other Extra information about the event.
 *     -int groupid: Group to display.
 *     -int date: Date to display logs from.
 *     -int modid: Module id for which logs were displayed.
 *     -string modaction: Module action.
 *     -string logformat: Log format in which logs were displayed.
 *
 * @package    report_log
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_viewed extends \core\event\base {

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventreportviewed', 'report_log');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id " . $this->userid . " viewed log report for course with id " . $this->courseid;
    }

    /**
     * Return the legacy event log data.
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array($this->courseid, "course", "report log", "report/log/index.php?id=$this->courseid", $this->courseid);
    }

    /**
     * Returns relevant URL.
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/report/log/index.php', array('id' => $this->courseid));
    }

    /**
     * Custom validation.
     *
     * @throws \coding_exception
     * @return void
     */
    protected function validate_data() {
        parent::validate_data();
        if (!isset($this->data['other']['groupid'])) {
            throw new \coding_exception('The property groupid must be set in other.');
        }

        if (!isset($this->data['other']['date'])) {
            throw new \coding_exception('The property date must be set in other.');
        }

        if (!isset($this->data['other']['modid'])) {
            throw new \coding_exception('The property modid must be set in other.');
        }

        if (!isset($this->data['other']['modaction'])) {
            throw new \coding_exception('The property modaction must be set in other.');
        }

        if (!isset($this->data['other']['logformat'])) {
            throw new \coding_exception('The property logformat must be set in other.');
        }

        if (!isset($this->data['relateduserid'])) {
            throw new \coding_exception('The property relateduserid must be set.');
        }
    }
}

