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
 *  This {@link aCssToken CSS token} represents the start of a @media at-rule block.
 * --
 *
 * @package		CssMin
 * @link		http://code.google.com/p/cssmin/
 * @author		Joe Scylla <joe.scylla@gmail.com>
 * @copyright	2008 - 2011 Joe Scylla <joe.scylla@gmail.com>
 * @license		http://opensource.org/licenses/mit-license.php MIT License
 * @version		3.0.0
 */
class CssAtMediaStartToken extends aCssToken
	{
	/**
	 * Sets the properties of the @media at-rule.
	 * 
	 * @param array $mediaTypes Media types
	 * @return void
	 */
	public function __construct(array $mediaTypes = array())
		{
		$this->MediaTypes = $mediaTypes;
		}
	/**
	 * Implements {@link aCssToken::__toString()}.
	 * 
	 * @return string
	 */
	public function __toString()
		{
		return "@media " . implode(",", $this->MediaTypes) . "{";
		}
	}
?>