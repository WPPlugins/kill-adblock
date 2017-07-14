<?php
/**
 * Block AdBlock 1.3.0 initiate .
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Random Name.
 */
if(get_option('kill_adBlock_random_class_name')==0)
{
    $kill_adblock_name = 'kill-adblock';
}else{
    $kill_adblock_name='k'.substr(md5(rand(99,999999)),5,5);
}
/**
 * Load plugin textdomain.
 */
function killadblock_load_textdomain() {
  load_plugin_textdomain( 'kill-adblock', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'killadblock_load_textdomain' );
/**
 * Enqueue scripts and styles.
 */
// removed from version 1.3
/**
 * initiate javascript.
 */
function kill_adblock_init()
{
    global $kill_adblock_name;
    if(get_option('kill_adBlock_status')==1)
    {?>
<style>
.<?php echo $kill_adblock_name?>{
    font-size: 18px;
}
.close-btn{
    position: absolute;
    right: 5px;
    top:-15px;
    background: #333;
    border-radius:50%;
    height: 25px;
    width: 25px;
    text-align: center;
    cursor: pointer;
}
.<?php echo $kill_adblock_name?>-hide{
    display: none;
}
.<?php echo $kill_adblock_name?>-1{
    width: 100%;
    background: #e84206;
    color: #fff;
    text-align: center;
    position: fixed;
    bottom: 0px;
    padding: 10px;
    z-index: 100000;
}
/** Full Screen Style **/
.<?php echo $kill_adblock_name?>-2{
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .95);
    z-index: 100000;
    position: fixed;
    top: 0;
    right: 0;
}
.<?php echo $kill_adblock_name?>-2 .<?php echo $kill_adblock_name?>-body,.<?php echo $kill_adblock_name?>-3 .<?php echo $kill_adblock_name?>-body{
    background: #fff;
    color: #666;
    text-align: center;
    position: fixed;
    margin: auto;
    top: 200px;
    right: 10%;
    width: 80%;
    padding: 20px;
    z-index: 100001;
    border-radius: 10px;
}
.<?php echo $kill_adblock_name?>-2 .close-btn,.<?php echo $kill_adblock_name?>-3 .close-btn{
    background: #e84206;
    color: #fff;
}
/**  Flying Box Style **/
.<?php echo $kill_adblock_name?>-3 .<?php echo $kill_adblock_name?>-body{
    box-shadow: 2px 2px 2px #333;
}

</style>
<script>
    
    (function(window) {
    	var KillAdBlock = function(options) {
    		this._options = {
    			checkOnLoad:		false,
    			resetOnEnd:			false,
    			loopCheckTime:		50,
    			loopMaxNumber:		5,
    			baitClass:			'pub_300x250 pub_300x250m pub_728x90 text-ad textAd text_ad text_ads text-ads text-ad-links',
    			baitStyle:			'width: 1px !important; height: 1px !important; position: absolute !important; left: -10000px !important; top: -1000px !important;',
    			debug:				false
    		};
    		this._var = {
    			version:			'1.2.0',
    			bait:				null,
    			checking:			false,
    			loop:				null,
    			loopNumber:			0,
    			event:				{ detected: [], notDetected: [] }
    		};
    		if(options !== undefined) {
    			this.setOption(options);
    		}
    		var self = this;
    		var eventCallback = function() {
    			setTimeout(function() {
    				if(self._options.checkOnLoad === true) {
    					if(self._options.debug === true) {
    						self._log('onload->eventCallback', 'A check loading is launched');
    					}
    					if(self._var.bait === null) {
    						self._creatBait();
    					}
    					setTimeout(function() {
    						self.check();
    					}, 1);
    				}
    			}, 1);
    		};
    		if(window.addEventListener !== undefined) {
    			window.addEventListener('load', eventCallback, false);
    		} else {
    			window.attachEvent('onload', eventCallback);
    		}
    	};
    	KillAdBlock.prototype._options = null;
    	KillAdBlock.prototype._var = null;
    	KillAdBlock.prototype._bait = null;
    	
    	KillAdBlock.prototype._log = function(method, message) {
    		console.log('[KillAdBlock]['+method+'] '+message);
    	};
    	
    	KillAdBlock.prototype.setOption = function(options, value) {
    		if(value !== undefined) {
    			var key = options;
    			options = {};
    			options[key] = value;
    		}
    		for(var option in options) {
    			this._options[option] = options[option];
    			if(this._options.debug === true) {
    				this._log('setOption', 'The option "'+option+'" he was assigned to "'+options[option]+'"');
    			}
    		}
    		return this;
    	};
    	
    	KillAdBlock.prototype._creatBait = function() {
    		var bait = document.createElement('div');
    			bait.setAttribute('class', this._options.baitClass);
    			bait.setAttribute('style', this._options.baitStyle);
    		this._var.bait = window.document.body.appendChild(bait);
    		
    		this._var.bait.offsetParent;
    		this._var.bait.offsetHeight;
    		this._var.bait.offsetLeft;
    		this._var.bait.offsetTop;
    		this._var.bait.offsetWidth;
    		this._var.bait.clientHeight;
    		this._var.bait.clientWidth;
    		
    		if(this._options.debug === true) {
    			this._log('_creatBait', 'Bait has been created');
    		}
    	};
    	KillAdBlock.prototype._destroyBait = function() {
    		window.document.body.removeChild(this._var.bait);
    		this._var.bait = null;
    		
    		if(this._options.debug === true) {
    			this._log('_destroyBait', 'Bait has been removed');
    		}
    	};
    	
    	KillAdBlock.prototype.check = function(loop) {
    		if(loop === undefined) {
    			loop = true;
    		}
    		
    		if(this._options.debug === true) {
    			this._log('check', 'An audit was requested '+(loop===true?'with a':'without')+' loop');
    		}
    		
    		if(this._var.checking === true) {
    			if(this._options.debug === true) {
    				this._log('check', 'A check was canceled because there is already an ongoing');
    			}
    			return false;
    		}
    		this._var.checking = true;
    		
    		if(this._var.bait === null) {
    			this._creatBait();
    		}
    		
    		var self = this;
    		this._var.loopNumber = 0;
    		if(loop === true) {
    			this._var.loop = setInterval(function() {
    				self._checkBait(loop);
    			}, this._options.loopCheckTime);
    		}
    		setTimeout(function() {
    			self._checkBait(loop);
    		}, 1);
    		if(this._options.debug === true) {
    			this._log('check', 'A check is in progress ...');
    		}
    		
    		return true;
    	};
    	KillAdBlock.prototype._checkBait = function(loop) {
    		var detected = false;
    		
    		if(this._var.bait === null) {
    			this._creatBait();
    		}
    		
    		if(window.document.body.getAttribute('abp') !== null
    		|| this._var.bait.offsetParent === null
    		|| this._var.bait.offsetHeight == 0
    		|| this._var.bait.offsetLeft == 0
    		|| this._var.bait.offsetTop == 0
    		|| this._var.bait.offsetWidth == 0
    		|| this._var.bait.clientHeight == 0
    		|| this._var.bait.clientWidth == 0) {
    			detected = true;
    		}
    		if(window.getComputedStyle !== undefined) {
    			var baitTemp = window.getComputedStyle(this._var.bait, null);
    			if(baitTemp.getPropertyValue('display') == 'none'
    			|| baitTemp.getPropertyValue('visibility') == 'hidden') {
    				detected = true;
    			}
    		}
    		
    		if(this._options.debug === true) {
    			this._log('_checkBait', 'A check ('+(this._var.loopNumber+1)+'/'+this._options.loopMaxNumber+' ~'+(1+this._var.loopNumber*this._options.loopCheckTime)+'ms) was conducted and detection is '+(detected===true?'positive':'negative'));
    		}
    		
    		if(loop === true) {
    			this._var.loopNumber++;
    			if(this._var.loopNumber >= this._options.loopMaxNumber) {
    				this._stopLoop();
    			}
    		}
    		
    		if(detected === true) {
    			this._stopLoop();
    			this._destroyBait();
    			this.emitEvent(true);
    			if(loop === true) {
    				this._var.checking = false;
    			}
    		} else if(this._var.loop === null || loop === false) {
    			this._destroyBait();
    			this.emitEvent(false);
    			if(loop === true) {
    				this._var.checking = false;
    			}
    		}
    	};
    	KillAdBlock.prototype._stopLoop = function(detected) {
    		clearInterval(this._var.loop);
    		this._var.loop = null;
    		this._var.loopNumber = 0;
    		
    		if(this._options.debug === true) {
    			this._log('_stopLoop', 'A loop has been stopped');
    		}
    	};
    	
    	KillAdBlock.prototype.emitEvent = function(detected) {
    		if(this._options.debug === true) {
    			this._log('emitEvent', 'An event with a '+(detected===true?'positive':'negative')+' detection was called');
    		}
    		
    		var fns = this._var.event[(detected===true?'detected':'notDetected')];
    		for(var i in fns) {
    			if(this._options.debug === true) {
    				this._log('emitEvent', 'Call function '+(parseInt(i)+1)+'/'+fns.length);
    			}
    			if(fns.hasOwnProperty(i)) {
    				fns[i]();
    			}
    		}
    		if(this._options.resetOnEnd === true) {
    			this.clearEvent();
    		}
    		return this;
    	};
    	KillAdBlock.prototype.clearEvent = function() {
    		this._var.event.detected = [];
    		this._var.event.notDetected = [];
    		
    		if(this._options.debug === true) {
    			this._log('clearEvent', 'The event list has been cleared');
    		}
    	};
    	
    	KillAdBlock.prototype.on = function(detected, fn) {
    		this._var.event[(detected===true?'detected':'notDetected')].push(fn);
    		if(this._options.debug === true) {
    			this._log('on', 'A type of event "'+(detected===true?'detected':'notDetected')+'" was added');
    		}
    		
    		return this;
    	};
    	KillAdBlock.prototype.onDetected = function(fn) {
    		return this.on(true, fn);
    	};
    	KillAdBlock.prototype.onNotDetected = function(fn) {
    		return this.on(false, fn);
    	};
    	
    	window.KillAdBlock = KillAdBlock;
    	
    	if(window.killAdBlock === undefined) {
    		window.killAdBlock = new KillAdBlock({
    			checkOnLoad: true,
    			resetOnEnd: true
    		});
    	}
    })(window);
    function show_message()
    {
        kill_adBlock_message_delay = kill_adBlock_message_delay * 1000;
        kill_adBlock_close_automatically_delay = kill_adBlock_close_automatically_delay * 1000;
        setTimeout(function(){
            jQuery('.<?php echo $kill_adblock_name?>').html(kill_adBlock_message);
            jQuery('.<?php echo $kill_adblock_name?>-container').fadeIn();
         }, kill_adBlock_message_delay);
        if(kill_adBlock_close_automatically_delay>0 && kill_adBlock_close_automatically==1)
        {
            setTimeout(function(){
                jQuery('.close-btn').trigger('click');
             }, kill_adBlock_close_automatically_delay);
        }
    }
    function adBlockNotDetected(){}
    jQuery(document).ready(function(){
        jQuery('.close-btn').click(function(){
            jQuery('.<?php echo $kill_adblock_name?>-container').fadeOut('<?php echo $kill_adblock_name?>-hide');
        });
    });
    var kill_adBlock_status = <?php echo kill_adblock_default_value(get_option('kill_adBlock_status'));?>;
    var kill_adBlock_message = '<?php echo addslashes(get_option('kill_adBlock_message'));?>';
    var kill_adBlock_message_delay = <?php echo kill_adblock_default_value(get_option('kill_adBlock_message_delay'));?>;
    var kill_adBlock_close_btn = <?php echo kill_adblock_default_value(get_option('kill_adBlock_close_btn'));?>;
    var kill_adBlock_close_automatically = <?php echo kill_adblock_default_value(get_option('kill_adBlock_close_automatically'));?>;
    var kill_adBlock_close_automatically_delay = <?php echo kill_adblock_default_value(get_option('kill_adBlock_close_automatically_delay'));?>;
    var kill_adBlock_message_type = <?php echo kill_adblock_default_value(get_option('kill_adBlock_message_type'));?>;
    function adBlockDetected() {
      show_message();
    }
    
    if(typeof killAdBlock === 'undefined') {
    	adBlockDetected();
    } else {
    	killAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
    }
</script>
    <?php }
}
add_action('wp_head', 'kill_adblock_init');
/**
 * return default value to javascript.
 */
function kill_adblock_default_value($value)
{
    if($value)
    {
        return $value;
    }else{
        return 0;
    }
}
/**
 * footer message.
 */
function kill_adblock_footer() {
    if(get_option('kill_adBlock_status')==1)
    {
        require 'footer-message.php';
    }
}
add_action( 'wp_footer', 'kill_adblock_footer' );