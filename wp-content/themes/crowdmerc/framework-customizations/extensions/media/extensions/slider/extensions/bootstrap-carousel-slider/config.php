<?php if (!defined('FW')) die('Forbidden');
/**
 * Specify available population methods.
 *
 * There are 4 built-in population methods:
 *  'posts'      Populate with posts
 *  'categories' Populate with categories
 *  'tags'       Populate with tags
 *  'custom'     Populate with custom content provided by the user
 */
//$cfg['population_methods'] = array('posts', 'categories', 'tags', 'custom');

$cfg['population_methods'] = array('custom');
/**
 * Specify what media types the slider supports.
 *
 * There are 2 media types available:
 *  'image' Supports images
 *  'video' Supports videos
 */
$cfg['multimedia_types'] = array('image');
