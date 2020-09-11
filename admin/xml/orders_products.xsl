<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
  <h4>Παραγγελίες</h4>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th>ID Παραγγελίας</th>
      <th>Όνομα Πελάτη</th>
		<th>Επώνυμο Πελάτη</th>
		<th>Κόστος</th>
    </tr>
    <xsl:for-each select="data/order">
    <tr>
      <td><xsl:value-of select="order_id"/></td>
      <td><xsl:value-of select="firstname"/></td>
	  <td><xsl:value-of select="lastname"/></td>
	  <td><xsl:value-of select="total_cost"/></td>
    </tr>
    </xsl:for-each>
  </table>
  <h4>Δημοφιλέστερα Προϊόντα</h4>
  <table border="1">
    <tr bgcolor="#F3031B">
      <th>ID Προϊόντος</th>
      <th>Ονομασία</th>
	  <th>Ποσότητα Πωλήσεων</th>
    </tr>
    <xsl:for-each select="data/popular_product">
    <tr>
      <td><xsl:value-of select="product_id"/></td>
      <td><xsl:value-of select="name"/></td>
	  <td><xsl:value-of select="product_total_sell_quantity"/></td>
    </tr>
    </xsl:for-each>
  </table> 
  </body>
  </html>
</xsl:template>
</xsl:stylesheet> 