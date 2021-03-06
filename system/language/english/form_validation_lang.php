<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    http://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']              = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter a valid {field} is empty</div>';
$lang['form_validation_isset']                 = 'The {field} field must have a value.';
$lang['form_validation_valid_email']           = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the correct {field} addresses</div>';
$lang['form_validation_valid_emails']          = 'The {field} field must contain all valid email addresses.';
$lang['form_validation_valid_url']             = 'The {field} field must contain a valid URL.';
$lang['form_validation_valid_ip']              = 'The {field} field must contain a valid IP.';
$lang['form_validation_min_length']            = 'The {field} field must be at least {param} characters in length.';
$lang['form_validation_max_length']            = 'The {field} field cannot exceed {param} characters in length.';
$lang['form_validation_exact_length']          = 'The {field} field must be exactly {param} characters in length.';
$lang['form_validation_alpha']                 = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the {field} only contain alphabetical characters and not spaces</div>';
$lang['form_validation_alpha_numeric']         = 'The {field} field may only contain alpha-numeric characters.';
$lang['form_validation_alpha_numeric_spaces']  = 'The {field} field may only contain alpha-numeric characters and spaces.';
$lang['form_validation_alpha_dash']            = 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.';
$lang['form_validation_numeric']               = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the {field} only contain only numbers</div>';
$lang['form_validation_is_numeric']            = 'The {field} field must contain only numeric characters.';
$lang['form_validation_integer']               = 'The {field} field must contain an integer.';
$lang['form_validation_regex_match']           = 'The {field} field is not in the correct format.';
$lang['form_validation_matches']               = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the correct same {field}</div>';
$lang['form_validation_differs']               = 'The {field} field must differ from the {param} field.';
$lang['form_validation_is_unique']             = 'The {field} field must contain a unique value.';
$lang['form_validation_is_natural']            = 'The {field} field must only contain digits.';
$lang['form_validation_is_natural_no_zero']    = 'The {field} field must only contain digits and must be greater than zero.';
$lang['form_validation_decimal']               = 'The {field} field must contain a decimal number.';
$lang['form_validation_less_than']             = 'The {field} field must contain a number less than {param}.';
$lang['form_validation_less_than_equal_to']    = 'The {field} field must contain a number less than or equal to {param}.';
$lang['form_validation_greater_than']          = 'The {field} field must contain a number greater than {param}.';
$lang['form_validation_greater_than_equal_to'] = 'The {field} field must contain a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set'] = 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']               = 'The {field} field must be one of: {param}.';
$lang['form_validation_birth_date_check']      = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the %s correctly and < 10 year now</div>';
$lang['form_validation_provinsi_check']        = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the %s is wrong</div>';
$lang['form_validation_email_check']           = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>%s addresses already, enter another email addresses</div>';
$lang['form_validation_kota_check']            = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the %s is wrong</div>';
$lang['form_validation_kategori_check']        = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the %s is wrong</div>';
$lang['form_validation_not_minus']             = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>%s value not minus</div>';
$lang['form_validation_select_check']          = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter the %s is wrong</div>';
$lang['form_validation_upload_check']          = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Upload %s is empty</div>';
$lang['form_validation_barang_check']          = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter another %s</div>';
$lang['form_validation_barang_temp']     = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter another %s</div>';
$lang['form_validation_barang_temp_id']     = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter another %s</div>';
$lang['form_validation_jumlah_refund']     = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>%s value not 0 or more than stock</div>';
$lang['form_validation_nama_kategori_barang']     = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>Enter another %s is already</div>';
$lang['form_validation_jumlah_beli']     = '<div class="col-md-4 col-md-offset-0 alert alert-danger" role="alert">
                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <span class="sr-only">Error:</span>%s too much not already stock</div>';
