<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Flash_Message Class
 *
 * @package		Flash_Message
 * @version		1.0
 * @author 		Richard Davey <info@richarddavey.com>
 * @copyright 	Copyright (c) 2011, Richard Davey
 * @link		https://github.com/richarddavey/codeigniter-flash_message
 */
class Flash_message {

	/**
	 * CodeIgniter instance
	 *
     */
	private $CI;
	
	/** 
	 * Message store
	 *
	 */
	private $messages = array();
	
	/** 
	 * Now message store
	 *
	 */
	private $now = array();
	
	/** 
	 * Grade states
	 *
	 */
	private $_htmlspecialchars	= TRUE;
	private $_session_var 		= 'flash_message';
	private $_flash_message 	= 'flash_message';
	private $_info_message 		= 'message_info';
	private $_error_message 	= 'message_error';
	private $_success_message	= 'message_success';
	private $_warning_message 	= 'message_warning';
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 */
	public function __construct($params = array())
	{
		// set up CI classes
		$this->CI =& get_instance();
		
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
		
		log_message('debug', "Flash_message Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	private function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->{'_' . $key}))
				{
					$this->{'_' . $key} = $val;
				}
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set message
	 *
	 * @param string $message
	 * @param string $type
	 * @return void
	 */
    function message($message, $type = '')
	{
		// set message
		$this->messages[] = array(
			'type' 		=> $type,
			'message' 	=> $message
		);
		
		// save to session
		$this->CI->session->set_flashdata($this->_session_var, $this->messages);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set message
	 *
	 * @param string $message
	 * @param string $type
	 * @return void
	 */
    function now($message, $type = '')
	{
		// set message
		$this->now[] = array(
			'type' 		=> $type,
			'message' 	=> $message
		);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Output html messages
	 *
	 * @return string html
	 */
    function display()
	{
		// get flashed messages
		$messages = $this->CI->session->flashdata($this->_session_var);
		
		// is array
		if ($messages AND is_array($messages)) 
		{
			// merge with now messages
			$messages = array_merge($messages, $this->now);
		} 
		else 
		{
			// get now messages
			$messages = $this->now;
		}
		
		// set default output
		$output = '';
		
		// load messages
		if ($messages AND is_array($messages)) 
		{
			// loop messages
			foreach ($messages as $message) 
			{
				// add to output
				$output .= '<div class="' . $this->_flash_message;
				$output .= $message['type'] ? ' ' . $message['type'] : '';
				$output .= '">';
				$output .= $this->_htmlspecialchars ? htmlspecialchars($message['message']) : $message['message'];
				$output .= '</div>';	
			}
		}
		return $output;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Output html message for form validation errors
	 *
	 * @param string $message
	 * @return string html
	 */
    function form_errors($message = '')
	{
		$this->CI->lang->load('flash_message');
		
		// set default error message
		if (!$message AND FALSE === ($message = $this->CI->lang->line('flash_message_form_errors')))
		{
			$message = 'There was a problem with your request, please check the information you provided.';
		}
		
		// set default output
		$output = '';
		
		// form validation
		if (function_exists('validation_errors') AND validation_errors()) 
		{
			$output  = '<div class="' . $this->_flash_message . ' ' . $this->_error_message . '">';
			$output .= $this->_htmlspecialchars ? htmlspecialchars($message) : $message;
			$output .= '</div>';
		}
		return $output;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Output all html flash messages and form validation errors
	 *
	 * @param string $message
	 * @return string html
	 */
    function show_all($message = '')
	{
		// set output
		$output  = $this->display();
		$output .= $this->form_errors($message);
		return $output;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set info message
	 *
	 * @param string $message
	 * @param boolean $now
	 * @return void
	 */
    function info($message, $now = FALSE)
	{
		// should message be displayed now
		if ($now) 
		{
			// call message function
			$this->now($message, $this->_info_message);
		} 
		else 
		{
			// call message function
			$this->message($message, $this->_info_message);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set error message
	 *
	 * @param string $message
	 * @param boolean $now
	 * @return void
	 */
    function error($message, $now = FALSE)
	{
		// should message be displayed now
		if ($now) 
		{
			// call message function
			$this->now($message, $this->_error_message);
		} 
		else 
		{
			// call message function
			$this->message($message, $this->_error_message);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set success message
	 *
	 * @param string $message
	 * @param boolean $now
	 * @return void
	 */
    function success($message, $now = FALSE)
	{
		// should message be displayed now
		if ($now) 
		{
			// call message function
			$this->now($message, $this->_success_message);
		} 
		else 
		{
			// call message function
			$this->message($message, $this->_success_message);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set warning message
	 *
	 * @param string $message
	 * @param boolean $now
	 * @return void
	 */
    function warning($message, $now = FALSE)
	{
		// should message be displayed now
		if ($now) 
		{
			// call message function
			$this->now($message, $this->_warning_message);
		} 
		else 
		{	
			// call message function
			$this->message($message, $this->_warning_message);
		}
	}
	
}
// END Flash_message Class

/* End of file Flash_message.php */
/* Location: ./system/libraries/Flash_message.php */