<?php
/**
 * CssMin - A (simple) css minifier with benefits
 * 
 * --
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING 
 * BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * --
 * 
 * This {@link aCssParserPlugin parser plugin} is responsible for parsing the @media at-rule block returns the 
 * {@link CssAtMediaStartToken} and {@link CssAtMediaEndToken} tokens.
 * --
 *
 * @package		CssMin
 * @link		http://code.google.com/p/cssmin/
 * @author		Joe Scylla <joe.scylla@gmail.com>
 * @copyright	2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 * @version		3.0.0
 */
class CssAtMediaParserPlugin extends aCssParserPlugin
	{
	/**
	 * Implements {@link aCssParserPlugin::TRIGGER_CHARS}.
	 * 
	 * @var string
	 */
	const TRIGGER_CHARS = "@{}";
	/**
	 * Implements {@link aCssParserPlugin::TRIGGER_STATES}.
	 * 
	 * @var string
	 */
	const TRIGGER_STATES = "T_DOCUMENT,T_AT_MEDIA::PREPARE,T_AT_MEDIA";
	/**
	 * Implements {@link aCssParserPlugin::parse()}.
	 * 
	 * @param integer $index Current index of the CssParser
	 * @param string $char Current char
	 * @param string $previousChar Previous char
	 * @return boolean
	 */
	public function parse($index, $char, $previousChar, $state)
		{
		if ($char === "@" && $state === "T_DOCUMENT" && strtolower(substr($this->parser->getSource(), $index, 6)) === "@media")
			{
			$this->parser->pushState("T_AT_MEDIA::PREPARE");
			$this->parser->clearBuffer();
			return $index + 6;
			}
		elseif ($char === "{" && $state === "T_AT_MEDIA::PREPARE")
			{
			$mediaTypes = array_filter(array_map("trim", explode(",", $this->parser->getAndClearBuffer("{"))));
			$this->parser->setMediaTypes($mediaTypes);
			$this->parser->setState("T_AT_MEDIA");
			$this->parser->appendToken(new CssAtMediaStartToken($mediaTypes));
			}
		elseif ($char === "}" && $state === "T_AT_MEDIA")
			{
			$this->parser->appendToken(new CssAtMediaEndToken());
			$this->parser->clearBuffer();
			$this->parser->unsetMediaTypes();
			$this->parser->popState();
			}
		else
			{
			return false;
			}
		return true;
		}
	}
?>