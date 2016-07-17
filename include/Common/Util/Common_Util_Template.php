<?php
namespace Common\Util;
/**
 * @package common
 * @subpackage util
 * @author kain
 *
 */
class Common_Util_Template {
	var $classname = "Common_Util_Template";
	var $debug = false;
	var $root = ".";
	var $file = array ();
	var $varkeys = array ();
	var $varvals = array ();
	var $unknowns = "remove";
	var $halt_on_error = "yes";
	var $last_error = "";
	var $charset = SYS_CHARSET;
	var $cooperate_config = array ();
	function Common_Util_Template($root = ".", $unknowns = "remove") {
		if ($this->debug & 4) {
			echo "<p><b>Common_Util_Template:</b> root = $root, unknowns = $unknowns</p>\n";
		}
		$this->set_root ( $root );
		$this->set_unknowns ( $unknowns );
		// $this->set_cooperate();
	}
	function set_root($root) {
		if ($this->debug & 4) {
			echo "<p><b>set_root:</b> root = $root</p>\n";
		}
		if (! is_dir ( $root )) {
			$this->halt ( "set_root: $root is not a directory." );
			return false;
		}

		$this->root = $root;
		return true;
	}
	function set_unknowns($unknowns = "remove") {
		if ($this->debug & 4) {
			echo "<p><b>unknowns:</b> unknowns = $unknowns</p>\n";
		}
		$this->unknowns = $unknowns;
	}
	function set_charset($charset = SYS_CHARSET) {
		$this->charset = $charset;
	}
	function set_cooperate() {
		// require('/data0/vshare/conf/cooperate_conf.php');
		if (! is_array ( $gCooperateConfig )) {
			$gCooperateConfig = array ();
		}
		$this->cooperate_config = $gCooperateConfig;
	}
	function set_file($varname, $filename = "") {

		// debug ��
		// add by Liulikang (2010-10-20)
		$GLOBALS ['arr_tpl_list'] [] = $filename;

		if (! is_array ( $varname )) {
			return $this->_set_file ( $varname, $filename );
		} else {
			reset ( $varname );
			while ( list ( $v, $f ) = each ( $varname ) ) {
				return $this->_set_file ( $v, $f );
			}
		}
		return true;
	}
	protected function _set_file($varname, $filename) {
		if ($this->debug & 4) {
			echo "<p><b>set_file:</b> varname = $varname, filename = $filename</p>\n";
		}
		if ($filename == "") {
			$this->halt ( "set_file: For varname $varname filename is empty." );
			return false;
		}

		if (! file_exists ( $this->root . $filename )) {
			$this->halt ( "set_file: File does not exist: " . $this->root . "$filename." );
			return false;
		}

		$this->file [$varname] = $this->filename ( $filename );
	}
	function set_block($parent, $varname, $name = "") {
		if ($this->debug & 4) {
			echo "<p><b>set_block:</b> parent = $parent, varname = $varname, name = $name</p>\n";
		}
		if (! $this->loadfile ( $parent )) {
			$this->halt ( "set_block: unable to load $parent." );
			return false;
		}
		if ($name == "") {
			$name = $varname;
		}

		$str = $this->get_var ( $parent );
		$reg = "/[ \t]*<!--\s+BEGIN $varname\s+-->\s*?\n?(\s*.*?\n?)\s*<!--\s+END $varname\s+-->\s*?\n?/sm";
		preg_match_all ( $reg, $str, $m );
		$str = preg_replace ( $reg, "{" . "$name}", $str );
		$this->set_var ( $varname, $m [1] [0] );
		$this->set_var ( $parent, $str );
		return true;
	}
	// ֱ�ӱ༭/ֱ����ʾ
	function set_escape_html_var($varname, $value = "", $append = false) {
		$value = htmlspecialchars ( $value );
		$this->set_var ( $varname, $value, $append );
	}
	// �򵥵���ΪJS��
	function set_escape_slash_var($varname, $value = "", $append = false) {
		$value = addslashes ( Common_Util_HtmlParse::forbidScript ( $value ) );
		$this->set_var ( $varname, $value, $append );
	}
	// ��ΪJS�������������ҳ��
	function set_escape_html_slash_var($varname, $value = "", $append = false) {
		$value = addslashes ( Common_Util_HtmlParse::forbidScript ( htmlspecialchars ( $value ) ) );
		$this->set_var ( $varname, $value, $append );
	}
	// ������ʾ
	function set_multiline_show_content($varname, $value = "", $append = false) {
		$value = nl2br ( htmlspecialchars ( $value ) );
		$this->set_var ( $varname, $value, $append );
	}
	// �������ı����õ��༭����
	function set_multiline_editor_content($varname, $value = "", $append = false) {
		$this->set_escape_html_var ( $varname, $value, $append );
	}
	// ��ת��
	function set_unescape_var($varname, $value = "", $append = false) {
		$this->set_var ( $varname, $value, $append );
	}
	// ��HTML��Ϊ��ͨ�ı����õ��༭����
	function set_editor_var($varname, $texttype, $value = "", $append = false) {
		if ($texttype == "plain") {
			$value = str_replace ( array (
					"\n",
					"\r"
			), array (
					"\\n",
					""
			), addslashes ( str_replace ( array (
					"&quot;",
					"&lt;",
					"&gt;",
					"&amp;"
			), array (
					"\"",
					"<",
					">",
					"&"
			), str_replace ( array (
					"<br />"
			), array (
					""
			), $value ) ) ) );
		} else if ($texttype == "html") {
			$value = str_replace ( array (
					"\n",
					"\r"
			), array (
					"\\n",
					""
			), addslashes ( $value ) );
		}
		$this->set_var ( $varname, $value, $append );
	}
	// JSON�����
	function set_json_var($varname, $value = "", $append = false) {
		$value = json_encode ( Common_Util_KxApiTool::toutf8 ( $value ) );
		$this->set_var ( $varname, $value, $append );
	}
	function set_var($varname, $value = "", $append = false) {
		if (! is_array ( $varname )) {
			if (! empty ( $varname )) {
				if ($this->debug & 1) {
					printf ( "<b>set_var:</b> (with scalar) <b>%s</b> = '%s'<br>\n", $varname, htmlentities ( $value ) );
				}
				$this->varkeys [$varname] = "/" . $this->varname ( $varname ) . "/";
				if ($append && isset ( $this->varvals [$varname] )) {
					$this->varvals [$varname] .= $value;
				} else {
					$this->varvals [$varname] = $value;
				}
			}
		} else {
			reset ( $varname );
			while ( list ( $k, $v ) = each ( $varname ) ) {
				if (! empty ( $k )) {
					if ($this->debug & 1) {
						printf ( "<b>set_var:</b> (with array) <b>%s</b> = '%s'<br>\n", $k, htmlentities ( $v ) );
					}
					$this->varkeys [$k] = "/" . $this->varname ( $k ) . "/";
					if ($append && isset ( $this->varvals [$k] )) {
						$this->varvals [$k] .= $v;
					} else {
						$this->varvals [$k] = $v;
					}
				}
			}
		}
	}
	function clear_var($varname) {
		if (! is_array ( $varname )) {
			if (! empty ( $varname )) {
				if ($this->debug & 1) {
					printf ( "<b>clear_var:</b> (with scalar) <b>%s</b><br>\n", $varname );
				}
				$this->set_var ( $varname, "" );
			}
		} else {
			reset ( $varname );
			while ( list ( $k, $v ) = each ( $varname ) ) {
				if (! empty ( $v )) {
					if ($this->debug & 1) {
						printf ( "<b>clear_var:</b> (with array) <b>%s</b><br>\n", $v );
					}
					$this->set_var ( $v, "" );
				}
			}
		}
	}
	function unset_var($varname) {
		if (! is_array ( $varname )) {
			if (! empty ( $varname )) {
				if ($this->debug & 1) {
					printf ( "<b>unset_var:</b> (with scalar) <b>%s</b><br>\n", $varname );
				}
				unset ( $this->varkeys [$varname] );
				unset ( $this->varvals [$varname] );
			}
		} else {
			reset ( $varname );
			while ( list ( $k, $v ) = each ( $varname ) ) {
				if (! empty ( $v )) {
					if ($this->debug & 1) {
						printf ( "<b>unset_var:</b> (with array) <b>%s</b><br>\n", $v );
					}
					unset ( $this->varkeys [$v] );
					unset ( $this->varvals [$v] );
				}
			}
		}
	}
	function subst($varname) {
		$varvals_quoted = array ();
		if ($this->debug & 4) {
			echo "<p><b>subst:</b> varname = $varname</p>\n";
		}
		if (! $this->loadfile ( $varname )) {
			$this->halt ( "subst: unable to load $varname." );
			return false;
		}

		// quote the replacement strings to prevent bogus stripping of special chars

		reset ( $this->varvals );
		while ( list ( $k, $v ) = each ( $this->varvals ) ) {
			if (strpos ( $v, "$" ) === false && strpos ( $v, "\\" ) === false) {
				$varvals_quoted [$k] = $v;
			} else {
				$varvals_quoted [$k] = str_replace ( array (
						"\\",
						"$"
				), array (
						"\\\\",
						"\\$"
				), $v );
			}
		}

		$str = $this->get_var ( $varname );
		$str = preg_replace ( $this->varkeys, $varvals_quoted, $str );
		return $str;
	}
	function psubst($varname) {
		if ($this->debug & 4) {
			echo "<p><b>psubst:</b> varname = $varname</p>\n";
		}
		print $this->subst ( $varname );

		return false;
	}
	function parse($target, $varname, $append = false) {
		if (! is_array ( $varname )) {
			if ($this->debug & 4) {
				echo "<p><b>parse:</b> (with scalar) target = $target, varname = $varname, append = $append</p>\n";
			}
			$str = $this->subst ( $varname );
			if ($append) {
				$this->set_var ( $target, $this->get_var ( $target ) . $str );
			} else {
				$this->set_var ( $target, $str );
			}
		} else {
			reset ( $varname );
			while ( list ( $i, $v ) = each ( $varname ) ) {
				if ($this->debug & 4) {
					echo "<p><b>parse:</b> (with array) target = $target, i = $i, varname = $v, append = $append</p>\n";
				}
				$str = $this->subst ( $v );
				if ($append) {
					$this->set_var ( $target, $this->get_var ( $target ) . $str );
				} else {
					$this->set_var ( $target, $str );
				}
			}
		}

		if ($this->debug & 4) {
			echo "<p><b>parse:</b> completed</p>\n";
		}
		if ($this->charset == SYS_CHARSET) {
			$str = iconv ( DB_CHARSET, SYS_CHARSET . "//IGNORE", $str );
		}

		$server_name = $_SERVER ["SERVER_NAME"];
		if ("wap." == substr ( $server_name, 0, 4 )) {
			$arr1 = $arr2 = array ();
			for($i = 1; $i <= 31; $i ++) {
				$arr1 [] = chr ( $i );
				$arr2 [] = "";
			}
			$str = str_replace ( $arr1, $arr2, $str );
		}
		return $str;
	}
	function pparse($target, $varname, $append = false) {
		if ($this->debug & 4) {
			echo "<p><b>pparse:</b> passing parameters to parse...</p>\n";
		}
		print $this->finish ( $this->parse ( $target, $varname, $append ) );
		return false;
	}
	function get_vars() {
		if ($this->debug & 4) {
			echo "<p><b>get_vars:</b> constructing array of vars...</p>\n";
		}
		reset ( $this->varkeys );
		while ( list ( $k, $v ) = each ( $this->varkeys ) ) {
			$result [$k] = $this->get_var ( $k );
		}
		return $result;
	}
	function get_var($varname) {
		if (! is_array ( $varname )) {
			if (isset ( $this->varvals [$varname] )) {
				$str = $this->varvals [$varname];
			} else {
				$str = "";
			}
			if ($this->debug & 2) {
				printf ( "<b>get_var</b> (with scalar) <b>%s</b> = '%s'<br>\n", $varname, htmlentities ( $str ) );
			}
			return $str;
		} else {
			reset ( $varname );
			while ( list ( $k, $v ) = each ( $varname ) ) {
				if (isset ( $this->varvals [$v] )) {
					$str = $this->varvals [$v];
				} else {
					$str = "";
				}
				if ($this->debug & 2) {
					printf ( "<b>get_var:</b> (with array) <b>%s</b> = '%s'<br>\n", $v, htmlentities ( $str ) );
				}
				$result [$v] = $str;
			}
			return $result;
		}
	}
	function get_undefined($varname) {
		if ($this->debug & 4) {
			echo "<p><b>get_undefined:</b> varname = $varname</p>\n";
		}
		if (! $this->loadfile ( $varname )) {
			$this->halt ( "get_undefined: unable to load $varname." );
			return false;
		}

		preg_match_all ( "/{([^ \t\r\n}:;#]+)}/", $this->get_var ( $varname ), $m );
		$m = $m [1];
		if (! is_array ( $m )) {
			return false;
		}

		reset ( $m );
		while ( list ( $k, $v ) = each ( $m ) ) {
			if (! isset ( $this->varkeys [$v] )) {
				if ($this->debug & 4) {
					echo "<p><b>get_undefined:</b> undefined: $v</p>\n";
				}
				$result [$v] = $v;
			}
		}

		if (count ( $result )) {
			return $result;
		} else {
			return false;
		}
	}
	function finish($str) {
		switch ($this->unknowns) {
			case "keep" :
				break;

			case "remove" :
				$str = preg_replace ( '/{[^ \t\r\n}:;#\"\',]+}/', "", $str );
				break;

			case "comment" :
				$str = preg_replace ( '/{[^ \t\r\n}:;#\"\',]+}/', "<!-- Common_Util_Template variable \\1 undefined -->", $str );
				break;
		}

		return $str;
	}
	function p($varname) {
		print $this->finish ( $this->get_var ( $varname ) );
	}
	function p_with_time($varname, $exp) {
		$lastmodi = date ( DATE_RFC1123, time () );
		$expirs = date ( DATE_RFC1123, time () + $exp );

		header ( "Last-Modified: $lastmodi" );
		header ( "Expires: $expirs" );

		print $this->finish ( $this->get_var ( $varname ) );
	}
	function p_return($varname) {
		return $this->finish ( $this->get_var ( $varname ) );
	}
	function get($varname) {
		return $this->finish ( $this->get_var ( $varname ) );
	}
	function filename($filename) {
		if ($this->debug & 4) {
			echo "<p><b>filename:</b> filename = $filename</p>\n";
		}
		$filename = $this->set_my_template ( $filename );
		/*
		 * if (substr($filename, 0, 1) != "/") {
		 * $filename = $this->root."/".$filename;
		 * }
		 */
		// echo "\$filename = $filename <br/>";
		$file_ext = $this->file_extension ( $filename );

		if (($file_ext != "html") && ($file_ext != "htm") && ($file_ext != "tpl")) {
			$this->halt ( "filename: file $filename does not exist." );
		}

		if (! file_exists ( $filename )) {
			$this->halt ( "filename: file $filename does not exist." );
		}
		return $filename;
	}
	function file_extension($filename) {
		return strtolower ( substr ( strrchr ( trim ( $filename ), '.' ), 1 ) );
	}
	function set_my_template($filename) {
		if (substr ( $filename, 0, 1 ) == "/") {
			return $filename;
		}
		if (isset ( $_SERVER )) {
			$hostName = strtolower ( $_SERVER ['SERVER_NAME'] );
		} else {
			$hostName = strtolower ( getenv ( 'SERVER_NAME' ) );
		}
		$newfilename = '';
		if (count ( $this->cooperate_config ) > 0) {
			foreach ( $this->cooperate_config as $value ) {
				if ($hostName == strtolower ( trim ( $value ['server'] ) )) {
					$newfilename = trim ( $value ['path'] ) . "/" . $filename;
					// echo "find -> $newfilename <br/>";
					if (! @file_exists ( $newfilename )) {
						$newfilename = '';
					}
					break;
				}
			}
		}
		if (strlen ( $newfilename ) == 0) {
			$newfilename = $this->root . "/" . $filename;
		}
		return $newfilename;
	}
	function varname($varname) {
		return preg_quote ( "{" . $varname . "}" );
	}
	function loadfile($varname) {
		if ($this->debug & 4) {
			echo "<p><b>loadfile:</b> varname = $varname</p>\n";
		}

		if (! isset ( $this->file [$varname] )) {
			// $varname does not reference a file so return
			if ($this->debug & 4) {
				echo "<p><b>loadfile:</b> varname $varname does not reference a file</p>\n";
			}
			return true;
		}

		if (isset ( $this->varvals [$varname] )) {
			// will only be unset if varname was created with set_file and has never been loaded
			// $varname has already been loaded so return
			if ($this->debug & 4) {
				echo "<p><b>loadfile:</b> varname $varname is already loaded</p>\n";
			}
			return true;
		}
		$filename = $this->file [$varname];

		/* use @file here to avoid leaking filesystem information if there is an error */
		$str = implode ( "", @file ( $filename ) );
		if (empty ( $str )) {
			$this->halt ( "loadfile: While loading $varname, $filename does not exist or is empty." );
			return false;
		}

		if ($this->debug & 4) {
			printf ( "<b>loadfile:</b> loaded $filename into $varname<br>\n" );
		}

		// $str = $this->movePublicMessage($str);

		if (defined ( 'ENV_IS_LITE' ) && true === ENV_IS_LITE && false !== strpos ( $filename, 'head' )) {
			// Lite ��Ҫ�滻 title Ϊ "��������"���� title ��ǩ�� "������" д����ģ�����Ҫ��ȫ���滻����ɾ���߼�
			$str = str_replace ( '������</title>', '��������</title>', $str );
		}

		$this->set_var ( $varname, $str );

		return true;
	}
	function halt($msg) {
		$this->last_error = $msg;

		if ($this->halt_on_error != "no") {
			$this->haltmsg ( $msg );
		}

		if ($this->halt_on_error == "yes") {
			die ( "<b>Halted.</b>" );
		}

		return false;
	}
	function haltmsg($msg) {
		global $multilog;
		$multilog = new Common_Util_MultiLog ();
		$multilog->addFileLog ( "showerror", "<b>Common_Util_Template Error:</b> $msg<br>\n" );
	}

	/**
	 * ȥ���ϵͳ��
	 * <!--[277,2,26] published at 2005-10-17 10:10:11 from #013 by 781-->
	 * ��ǣ�ʹҳ�����ʾ�ﵽXHTML+CSS��׼
	 * Add by Lijunjie
	 * 2005-10-17
	 */
	function movePublicMessage($input) {
		if (strlen ( $input ) < 50) {
			return $input;
		}

		$reg = "/<!--\[[0-9,]+\]\s+published\s+at\s+(.*)-->\n*/m";

		$out = preg_replace ( $reg, '', $input );

		return $out;
	}
}
?>
