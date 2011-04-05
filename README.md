# CodeIgniter-Registry

CodeIgniter-Flash_Message is a stack system for outputting messages.


## Requirements

* CodeIgniter 2.0.x


## Installation

You may want to use the following base CSS to style your own messages:

	/* Flash_Message Base CSS */

	div.flash_message {
		cursor: pointer;
		background-repeat: no-repeat;
		background-position: 5px 50%;
		line-height: 16px;
		padding: 5px 5px 5px 30px;
		margin-bottom: 10px;
	}
	
	div.message_success {
		color: #138C41;
		-moz-border-radius: 	2px; /* Firefox */
		-webkit-border-radius: 	2px; /* Safari and Chrome */
		-khtml-border-radius: 	2px; /* Linux */ 
		border-radius: 			2px; /* CSS3 */
		border: 1px solid #138c41;
		background-color: #ccffcc;
		background-image: url(http://p.yusukekamiyamane.com/icons/search/fugue/icons/tick-button.png);
	}
	
	div.message_info {
		color: #467AA7;
		-moz-border-radius: 	2px; /* Firefox */
		-webkit-border-radius: 	2px; /* Safari and Chrome */
		-khtml-border-radius: 	2px; /* Linux */ 
		border-radius: 			2px; /* CSS3 */
		border: 1px solid #467aa7;
		background-color: #cedef4;
		background-image: url(http://p.yusukekamiyamane.com/icons/search/fugue/icons/information-button.png);
	}
	
	div.message_error {
		color: #F0381A;
		-moz-border-radius: 	2px; /* Firefox */
		-webkit-border-radius: 	2px; /* Safari and Chrome */
		-khtml-border-radius: 	2px; /* Linux */ 
		border-radius: 			2px; /* CSS3 */
		border: 1px solid #f0381a;
		background-color: #ffcccc;
		background-image: url(http://p.yusukekamiyamane.com/icons/search/fugue/icons/cross-button.png);
	}
	
	div.message_warning {
		color: #666;
		-moz-border-radius: 	2px; /* Firefox */
		-webkit-border-radius: 	2px; /* Safari and Chrome */
		-khtml-border-radius: 	2px; /* Linux */ 
		border-radius: 			2px; /* CSS3 */
		border: 1px solid #efdc0e;
		background-color: #fff699;
		background-image: url(http://p.yusukekamiyamane.com/icons/search/fugue/icons/exclamation-button.png);
	}
	

## Example

	// add a flash message to stack
	$this->flash_message->info('This is an info message');
	$this->flash_message->error('This is an error message');
	$this->flash_message->success('This is a success message');
	$this->flash_message->info('This is a warning message');
	
	// add a flash message for display this page load
	$this->flash_message->info('This message does not require a page redirect', TRUE);
	
	// for use in view to output flash messages
	echo $this->flash_message->display();
	
	// for use in view to detect form error
	echo $this->flash_message->form_errors();
	
	// show flash messages and form error message
	echo $this->flash_message->show_all();