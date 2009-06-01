<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Archive driver interface.
 *
 * $Id: Archive.php 3769 2008-12-15 00:48:56Z zombor $
 *
 * @package    Archive
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
interface Archive_Driver {

	/**
	 * Creates an archive and optionally, saves it to a file.
	 *
	 * @param   array    filenames to add
	 * @param   string   file to save the archive to
	 * @return  boolean
	 */
	public function create($paths, $filename = FALSE);

	/**
	 * Add data to the archive.
	 *
	 * @param   string   filename
	 * @param   string   name of file in archive
	 * @return  void
	 */
	public function add_data($file, $name, $contents = NULL);

} // End Archive_Driver Interface