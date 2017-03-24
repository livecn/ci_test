<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$config['pagination'] = array(
    'reuse_query_string' => TRUE,
    'per_page' => 10,
    'use_page_numbers' => TRUE,
    'full_tag_open' => '<ul class="pagination">',
    'full_tag_close' => '</ul>',
    'prev_link' => '‹',
    'prev_tag_open' => '<li>',
    'prev_tag_close' => '</li>',
    'next_link' => '›',
    'next_tag_open' => '<li>',
    'next_tag_close' => '</li>',
    'cur_tag_open' => '<li class="active"><a href="javascript:void(0)">',
    'cur_tag_close' => '</a></li>',
    'num_tag_open' => '<li>',
    'num_tag_close' => '</li>',
    'last_link' => '»',
    'last_tag_open' => '<li>',
    'last_tag_close' => '</li>',
    'first_link' => '«',
    'first_tag_open' => '<li>',
    'first_tag_close' => '</li>',
);
