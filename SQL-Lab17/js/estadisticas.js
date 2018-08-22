
$('th').click(function() {
   var table = $(this).parents('table').eq(0)
   var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
   this.asc = !this.asc
   if (!this.asc) {
      rows = rows.reverse()
   }
   for (var i = 0; i < rows.length; i++) {
      table.append(rows[i])
   }
   setIcon($(this), this.asc);
});


// Para comparar los valores de la tabla entre sí
function comparer(index) {
   return function(a, b) {
      var valA = getCellValue(a, index),
      valB = getCellValue(b, index)
      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
   }
}

// Obtiene los valores de cada celda
function getCellValue(row, index) {
   return $(row).children('td').eq(index).html()
}

// Muestra gráficamente qué ordenamiento se está aplicando
function setIcon(element, asc) {
   $("th").each(function(index) {
      $(this).removeClass("sorting");
      $(this).removeClass("asc");
      $(this).removeClass("desc");
   });
   element.addClass("sorting");
   if (asc) element.addClass("asc");
   else element.addClass("desc");
}

