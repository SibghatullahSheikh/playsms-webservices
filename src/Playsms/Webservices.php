<?php


/*
 * The MIT License
 *
 * Copyright 2014 Anton Raharja <antonrd at gmail dot com>.
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
 */

/**
 * playSMS Webservices
 *
 * @author Anton Raharja
 */

namespace Playsms;

class Webservices {

	private $last_response;

	public $url;
	public $token;
	public $username;
	public $password;
	public $operation;
	public $format;
	public $from;
	public $to;
	public $footer;
	public $nofooter;
	public $msg;
	public $schedule;
	public $type;
	public $unicode;
	public $queue;
	public $src;
	public $dst;
	public $datetime;
	public $smslog_id;
	public $last_smslog_id;
	public $count;
	public $keyword;

	/**
	 * Fetch content from URL
	 * @param string $ws_url Webservices URL
	 * @return string
	 */
	private function _Fetch($ws_url) {
		return file_get_contents($ws_url);
	}

	/**
	 * Get last response from last called method as an object
	 * @return mixed
	 */
	public function getLastResponse() {
		$object = '';
		if ($this->last_response && (! $this->format || $this->format == 'json')) {
			$object = json_decode($this->last_response);
		}
		return $object;
	}

	/**
	 * Get user's credit
	 * @return string
	 */
	public function getCredit() {
		$ws_url = $this->url;
		$ws_url .= '&op=cr';
		$ws_url .= '&u='.$this->username;
		$ws_url .= '&h='.$this->token;
		if ($this->format) {
			$ws_url .= '&format='.$this->format;
		}
		$this->last_response = $this->_Fetch($ws_url);
		return $this->last_response;
	}

	/**
	 * Get webservices token. This operation can also be used as a login mechanism.
	 * @return string
	 */
	public function getToken() {
		$ws_url = $this->url;
		$ws_url .= '&op=get_token';
		$ws_url .= '&u='.$this->username;
		$ws_url .= '&p='.$this->password;
		if ($this->format) {
			$ws_url .= '&format='.$this->format;
		}
		$this->last_response = $this->_Fetch($ws_url);
		return $this->last_response;
	}

	/**
	 * Set new webservices token. This operation can also be used as a change password/token mechanism.
	 * @return string
	 */
	public function setToken() {
		$ws_url = $this->url;
		$ws_url .= '&op=set_token';
		$ws_url .= '&u='.$this->username;
		$ws_url .= '&h='.$this->token;
		if ($this->format) {
			$ws_url .= '&format='.$this->format;
		}
		$this->last_response = $this->_Fetch($ws_url);
		return $this->last_response;
	}

}