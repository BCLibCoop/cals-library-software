<?xml version="1.0" encoding="utf-8"?>
<?build-xslt-doc disable-output-escaping?>
<!--
<pre>
	DTBook to Flow for braille (sv_SE)

	Description
	DTBook to Flow stylesheet for Swedish braille.

	Parameters
		page-width (inherited)
		page-height (inherited)
		inner-margin (inherited)
		outer-margin (inherited)
		row-spacing (inherited)
		duplex (inherited)

	Format (input -> output)
		DTBook -> Flow

	Author: Joel Håkansson, TPB
</pre>
<h2>Summary</h2>
		<table border="1px">
			<tr>
				<th>Element</th>
				<th>Category</th>
				<th>Category description</th>
				<th>Action summary</th>
				<th>Default action</th>
			</tr>
			<tr>
				<td>bodymatter</td>
				<td>Sequence</td>
				<td/>
				<td>New sequence, restart pagination</td>
				<td/>
			</tr>
			<tr>
				<td>frontmatter</td>
				<td>Sequence</td>
				<td/>
				<td>New sequence, restart pagination</td>
				<td/>
			</tr>
			<tr>
				<td>rearmatter</td>
				<td>Sequence</td>
				<td/>
				<td>New sequence, continue pagination</td>
				<td/>
			</tr>
			<tr>
				<td>level</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>level1</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, break page before, margin top = 3 unless h1</td>
				<td/>
			</tr>
			<tr>
				<td>level2</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, margin top = 2 unless h2</td>
				<td/>
			</tr>
			<tr>
				<td>level3</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, margin top = 1 unless h3</td>
				<td/>
			</tr>
			<tr>
				<td>level4</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, margin top = 1 unless h4</td>
				<td/>
			</tr>
			<tr>
				<td>level5</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, margin top = 1 unless h5</td>
				<td/>
			</tr>
			<tr>
				<td>level6</td>
				<td>Block (type 1)</td>
				<td>no text</td>
				<td>New block, margin top = 1 unless h6</td>
				<td/>
			</tr>
			<tr>
				<td>list</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td>[complex]</td>
				<td/>
			</tr>
			<tr>
				<td>blockquote</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td>New block, margin left = 2, margin top = 1, margin bottom = 1</td>
				<td/>
			</tr>
			<tr>
				<td>linegroup</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td>New block, if preceeded by linegroup margin top = 1</td>
				<td/>
			</tr>
			<tr>
				<td>poem</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td>New block, margin top = 1, margin bottom = 1</td>
				<td/>
			</tr>
			<tr>
				<td>div</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td>New block, margin bottom = 1</td>
				<td/>
			</tr>
			<tr>
				<td>annotation</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>dl</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>imggroup</td>
				<td>Block (type 2)</td>
				<td>text sibling</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>bridgehead</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>caption</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>Surround block with delimiters</td>
				<td/>
			</tr>
			<tr>
				<td>covertitle</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>docauthor</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>Ignore (generated on title page instead)</td>
				<td/>
			</tr>
			<tr>
				<td>doctitle</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>Ignore (generated on title page instead)</td>
				<td/>
			</tr>
			<tr>
				<td>li</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>Processing depends on type-attribute</td>
				<td/>
			</tr>
			<tr>
				<td>h1</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 3 (margin bottom = 1 unless directly followed by level2)</td>
				<td/>
			</tr>
			<tr>
				<td>h2</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 2 (margin bottom = 1 unless directly followed by level3)</td>
				<td/>
			</tr>
			<tr>
				<td>h3</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 1 (margin bottom = 1 unless directly followed by level4)</td>
				<td/>
			</tr>
			<tr>
				<td>h4</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 1 (margin bottom = 1 unless directly followed by level5)</td>
				<td/>
			</tr>
			<tr>
				<td>h5</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 1 (margin bottom = 1 unless directly followed by level6)</td>
				<td/>
			</tr>
			<tr>
				<td>h6</td>
				<td>Block (type 3)</td>
				<td>text child</td>
				<td>New block, margin top = 1, margin bottom = 1</td>
				<td/>
			</tr>
			<tr>
				<td>author</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>address</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>hd</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>line</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td>New block, text indent = 2</td>
				<td/>
			</tr>
			<tr>
				<td>p</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td>New block, layout depends on class-attribute</td>
				<td/>
			</tr>
			<tr>
				<td>sidebar</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>byline</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>dateline</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>epigraph</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td/>
				<td>New block</td>
			</tr>
			<tr>
				<td>prodnote</td>
				<td>Block (type 4)</td>
				<td>text sibling and/or text child</td>
				<td>Surround block with delimiters</td>
				<td>New block</td>
			</tr>
			<tr>
				<td>a</td>
				<td>Inline/Block</td>
				<td/>
				<td/>
				<td>New block, if block context</td>
			</tr>
			<tr>
				<td>cite</td>
				<td>Inline/Block</td>
				<td/>
				<td/>
				<td>New block, if block context</td>
			</tr>
			<tr>
				<td>kbd</td>
				<td>Inline/Block</td>
				<td/>
				<td/>
				<td>New block, if block context</td>
			</tr>
			<tr>
				<td>samp</td>
				<td>Inline/Block</td>
				<td/>
				<td/>
				<td>New block, if block context</td>
			</tr>
			<tr>
				<td>code</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>bdo</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>em</td>
				<td>Inline</td>
				<td/>
				<td>Add braille markers for emphasis</td>
				<td/>
			</tr>
			<tr>
				<td>strong</td>
				<td>Inline</td>
				<td/>
				<td>Add braille markers for strong</td>
				<td/>
			</tr>
			<tr>
				<td>span</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>sub</td>
				<td>Inline</td>
				<td/>
				<td>Add braille markers for subscript</td>
				<td/>
			</tr>
			<tr>
				<td>sup</td>
				<td>Inline</td>
				<td/>
				<td>Add braille markers for superscript</td>
				<td/>
			</tr>
			<tr>
				<td>abbr</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>acronym</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>dfn</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>q</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>noteref</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>annoref</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>sent</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>w</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>linenum</td>
				<td>Inline</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>lic</td>
				<td>Inline</td>
				<td/>
				<td>If inline and in toc, align right, fill space with ...</td>
				<td/>
			</tr>
			<tr>
				<td>dd</td>
				<td>Inline</td>
				<td/>
				<td>New block, text indent = 2, prefix with braille markers</td>
				<td/>
			</tr>
			<tr>
				<td>dt</td>
				<td>Inline</td>
				<td/>
				<td>New block</td>
				<td/>
			</tr>
			<tr>
				<td>br</td>
				<td>Special</td>
				<td/>
				<td/>
				<td>Break line</td>
			</tr>
			<tr>
				<td>pagenum</td>
				<td>Special</td>
				<td/>
				<td/>
				<td>Add pagenum marker</td>
			</tr>
			<tr>
				<td>book</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>dtbook</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>head</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>meta</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>link</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>img</td>
				<td>No-op</td>
				<td/>
				<td/>
				<td>Continue</td>
			</tr>
			<tr>
				<td>note</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>table</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>col</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>colgroup</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>tbody</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>td</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>tfoot</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>th</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>thead</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>title</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
			<tr>
				<td>tr</td>
				<td>Not supported</td>
				<td/>
				<td/>
				<td>Abort</td>
			</tr>
		</table>
-->
<!--
	TODO:
		- komplexa sub, sup
		- länkar, e-postadresser
-->
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:dtb="http://www.daisy.org/z3986/2005/dtbook/" exclude-result-prefixes="dtb">

	<xsl:import href="dtbook2flow_sv_SE.xsl" />
	<xsl:output method="xml" encoding="utf-8" indent="no"/>

	<xsl:template name="insertLayoutMaster">
		<layout-master name="front" page-width="{$page-width}" 
							page-height="{$page-height}" inner-margin="{$inner-margin}"
							outer-margin="{$outer-margin}" row-spacing="{$row-spacing}" duplex="{$duplex}">
			<template use-when="(= (% $page 2) 0)">
				<header>
					<field><current-page style="roman"/></field>
				</header>
				<footer></footer>
			</template>
			<default-template>
				<header>
					<field><string value=""/></field>
					<field><current-page style="roman"/></field>
				</header>
				<footer></footer>
			</default-template>
		</layout-master>
		<layout-master name="main" page-width="{$page-width}" 
							page-height="{$page-height}" inner-margin="{$inner-margin}"
							outer-margin="{$outer-margin}" row-spacing="{$row-spacing}" duplex="{$duplex}">
			<template use-when="(= (% $page 2) 0)">
				<header>
					<field><current-page style="default"/></field>
					<field>
						<marker-reference marker="pagenum-turn" direction="forward" scope="page_content"/>
						<marker-reference marker="pagenum" direction="backward" scope="sequence"/>
					</field>
				</header>
				<footer></footer>
			</template>
			<default-template>
				<header>
					<field>
						<marker-reference marker="pagenum-turn" direction="forward" scope="page_content"/>
						<marker-reference marker="pagenum" direction="backward" scope="sequence"/>
					</field>
					<field><current-page style="default"/></field>
				</header>
				<footer></footer>
			</default-template>
		</layout-master>
		<layout-master name="plain" page-width="{$page-width}" 
							page-height="{$page-height}" inner-margin="{$inner-margin}"
							outer-margin="{$outer-margin}" row-spacing="{$row-spacing}" duplex="{$duplex}">
			<default-template>
				<header><field><string value=""/></field></header>
				<footer></footer>
			</default-template>
		</layout-master>
	</xsl:template>

	<!-- Svenska skrivregler för punktskrift 2009, page 34 -->
	<xsl:template match="dtb:em[not(ancestor::dtb:list[@class='toc'])]" mode="inline-mode">
		<xsl:call-template name="addMarkers">
			<xsl:with-param name="prefix-single-word" select="'&#x2820;&#x2804;'"/>
			<xsl:with-param name="prefix-multi-word" select="'&#x2820;&#x2824;'"/>
			<xsl:with-param name="postfix-multi-word" select="'&#x2831;'"/>
		</xsl:call-template>
	</xsl:template>

	<!-- Svenska skrivregler för punktskrift 2009, page 34 -->
	<xsl:template match="dtb:strong[not(ancestor::dtb:list[@class='toc'])]" mode="inline-mode">
		<xsl:call-template name="addMarkers">
			<xsl:with-param name="prefix-single-word" select="'&#x2828;'"/>
			<xsl:with-param name="prefix-multi-word" select="'&#x2828;&#x2828;'"/>
			<xsl:with-param name="postfix-multi-word" select="'&#x2831;'"/>
		</xsl:call-template>
	</xsl:template>

	<!-- Svenska skrivregler för punktskrift 2009, page 32 -->
	<xsl:template match="dtb:sup" mode="inline-mode">
		<xsl:call-template name="addMarkersAlfaNum">
			<xsl:with-param name="prefix" select="'&#x282c;'"/>
			<xsl:with-param name="postfix" select="''"/>
		</xsl:call-template>
	</xsl:template>

	<!-- Svenska skrivregler för punktskrift 2009, page 32 -->
	<xsl:template match="dtb:sub" mode="inline-mode">
		<xsl:call-template name="addMarkersAlfaNum">
			<xsl:with-param name="prefix" select="'&#x2823;'"/>
			<xsl:with-param name="postfix" select="''"/>
		</xsl:call-template>
	</xsl:template>
	
	<!-- Redigering och avskrivning, page 148 -->
	<xsl:template match="dtb:dd" mode="block-mode">
		<block>
			<xsl:apply-templates select="." mode="apply-block-attributes"/>
			<xsl:text>&#x2820;&#x2804; </xsl:text><xsl:apply-templates/>
		</block>
	</xsl:template>

	<xsl:template name="addMarkersAlfaNum">
		<xsl:param name="prefix" select="''"/>
		<xsl:param name="postfix" select="''"/>
		<xsl:choose>
			<!-- text contains a single alfa/numerical string -->
			<xsl:when test="count(node())=1 and text() and matches(text(),'^[a-zA-Z0-9]*$')">
				<xsl:value-of select="$prefix"/>
				<xsl:apply-templates/>
				<xsl:value-of select="$postfix"/>
			</xsl:when>
			<!-- Otherwise -->
			<xsl:otherwise>
				<xsl:message terminate="no">Error: sub/sub contains a complex expression for which there is no specified formatting.</xsl:message>
				<xsl:apply-templates/>
			</xsl:otherwise>		
		</xsl:choose>
	</xsl:template>

	<xsl:template name="addMarkers">
		<xsl:param name="prefix-single-word" select="''"/>
		<xsl:param name="postfix-single-word" select="''"/>
		<xsl:param name="prefix-multi-word" select="''"/>
		<xsl:param name="postfix-multi-word" select="''"/>
		<xsl:choose>
			<xsl:when test="count(node())=0"><xsl:text> </xsl:text></xsl:when>
			<!-- if text contains one word only -->
			<xsl:when test="count(text())=1 and translate(text(), ' ', '')=text()">
				<xsl:value-of select="$prefix-single-word"/>
				<xsl:apply-templates/>
				<xsl:value-of select="$postfix-single-word"/>
			</xsl:when>
			<!-- text contains several words -->
			<xsl:otherwise>
				<xsl:value-of select="$prefix-multi-word"/>
				<xsl:apply-templates/>
				<xsl:value-of select="$postfix-multi-word"/>
			</xsl:otherwise>		
		</xsl:choose>
	</xsl:template>

</xsl:stylesheet>
