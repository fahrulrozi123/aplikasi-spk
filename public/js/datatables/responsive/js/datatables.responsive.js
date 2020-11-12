'use strict';function ResponsiveDatatablesHelper(tableSelector,breakpoints,options){if(typeof tableSelector==='string'){this.tableElement=jQuery(tableSelector);}else{this.tableElement=tableSelector;}
this.columnIndexes=[];this.columnsShownIndexes=[];this.columnsHiddenIndexes=[];this.expandColumn=undefined;this.breakpoints={};this.options={hideEmptyColumnsInRowDetail:false};this.expandIconTemplate='<span class="responsiveExpander"></span>';this.rowTemplate='<tr class="row-detail"><td><ul><!--column item--></ul></td></tr>';this.rowLiTemplate='<li><span class="columnTitle"><!--column title--></span>: <span class="columnValue"><!--column value--></span></li>';this.disabled=true;this.skipNextWindowsWidthChange=false;this.init(breakpoints,options);}
ResponsiveDatatablesHelper.prototype.init=function(breakpoints,options){breakpoints['always']=Infinity;var breakpointsSorted=[];_.each(breakpoints,function(value,key){breakpointsSorted.push({name:key,upperLimit:value,columnsToHide:[]});});breakpointsSorted=_.sortBy(breakpointsSorted,'upperLimit');var lowerLimit=undefined;_.each(breakpointsSorted,function(value){value.lowerLimit=lowerLimit;lowerLimit=value.upperLimit;});breakpointsSorted.push({name:'default',lowerLimit:lowerLimit,upperLimit:undefined,columnsToHide:[]});for(var i=0,l=breakpointsSorted.length;i<l;i++){this.breakpoints[breakpointsSorted[i].name]=breakpointsSorted[i];}
var columns=this.tableElement.fnSettings().aoColumns;for(var i=0,l=columns.length;i<l;i++){if(columns[i].bVisible){this.columnIndexes.push(i)}}
var headerColumns=this.tableElement.fnSettings().aoColumns;headerColumns=_.filter(headerColumns,function(col){return col.bVisible;});_.each(headerColumns,function(col,index){if(jQuery(col.nTh).attr('data-class')==='expand'){this.expandColumn=this.columnIndexes[index];}
var dataHide=jQuery(col.nTh).attr('data-hide');if(dataHide!==undefined){var splitBreakingPoints=dataHide.split(/,\s*/);_.each(splitBreakingPoints,function(e){if(this.breakpoints[e]!==undefined){this.breakpoints[e].columnsToHide.push(this.columnIndexes[index]);}},this);}},this);this.disable(false);_.extend(this.options,options);};ResponsiveDatatablesHelper.prototype.setWindowsResizeHandler=function(bindFlag){if(bindFlag===undefined){bindFlag=true;}
if(bindFlag){var that=this;jQuery(window).bind("resize",function(){that.respond();});}else{jQuery(window).unbind("resize");}}
ResponsiveDatatablesHelper.prototype.respond=function(){if(this.disabled){return;}
var that=this;var newWindowWidth=jQuery(window).width();var updatedHiddenColumnsCount=0;var newColumnsToHide=[];_.each(this.breakpoints,function(element){if((!element.lowerLimit||newWindowWidth>element.lowerLimit)&&(!element.upperLimit||newWindowWidth<=element.upperLimit)){newColumnsToHide=element.columnsToHide;}},this);var columnShowHide=false;if(!this.skipNextWindowsWidthChange){if(this.columnsHiddenIndexes.length!==newColumnsToHide.length){columnShowHide=true;}else{var d1=_.difference(this.columnsHiddenIndexes,newColumnsToHide).length;var d2=_.difference(newColumnsToHide,this.columnsHiddenIndexes).length;columnShowHide=d1+d2>0;}}
if(columnShowHide){this.skipNextWindowsWidthChange=true;this.columnsHiddenIndexes=newColumnsToHide;this.columnsShownIndexes=_.difference(this.columnIndexes,this.columnsHiddenIndexes);this.showHideColumns();updatedHiddenColumnsCount=this.columnsHiddenIndexes.length;this.skipNextWindowsWidthChange=false;}
if(this.columnsHiddenIndexes.length){this.tableElement.addClass('has-columns-hidden');jQuery('tr.detail-show',this.tableElement).each(function(index,element){var tr=jQuery(element);if(tr.next('.row-detail').length===0){ResponsiveDatatablesHelper.prototype.showRowDetail(that,tr);}});}else{this.tableElement.removeClass('has-columns-hidden');jQuery('tr.row-detail').each(function(event){ResponsiveDatatablesHelper.prototype.hideRowDetail(that,jQuery(this).prev());});}};ResponsiveDatatablesHelper.prototype.showHideColumns=function(){for(var i=0,l=this.columnsShownIndexes.length;i<l;i++){this.tableElement.fnSetColumnVis(this.columnsShownIndexes[i],true,false);}
for(var i=0,l=this.columnsHiddenIndexes.length;i<l;i++){this.tableElement.fnSetColumnVis(this.columnsHiddenIndexes[i],false,false);}
var that=this;jQuery('tr.row-detail').each(function(){ResponsiveDatatablesHelper.prototype.hideRowDetail(that,jQuery(this).prev());});if(this.tableElement.hasClass('has-columns-hidden')){jQuery('tr.detail-show',this.tableElement).each(function(index,element){ResponsiveDatatablesHelper.prototype.showRowDetail(that,jQuery(element));});}};ResponsiveDatatablesHelper.prototype.createExpandIcon=function(tr){if(this.disabled){return;}
var tds=jQuery('td',tr);var that=this;for(var i=0,l=tds.length;i<l;i++){var td=tds[i];var tdIndex=that.tableElement.fnGetPosition(td)[2];td=jQuery(td);if(tdIndex===that.expandColumn){if(jQuery('span.responsiveExpander',td).length==0){td.prepend(that.expandIconTemplate);td.on('click','span.responsiveExpander',{responsiveDatatablesHelperInstance:that},that.showRowDetailEventHandler);}
break;}}};ResponsiveDatatablesHelper.prototype.showRowDetailEventHandler=function(event){if(this.disabled){return;}
var tr=jQuery(this).closest('tr');if(tr.hasClass('detail-show')){ResponsiveDatatablesHelper.prototype.hideRowDetail(event.data.responsiveDatatablesHelperInstance,tr);}else{ResponsiveDatatablesHelper.prototype.showRowDetail(event.data.responsiveDatatablesHelperInstance,tr);}
tr.toggleClass('detail-show');event.stopPropagation();};ResponsiveDatatablesHelper.prototype.showRowDetail=function(responsiveDatatablesHelperInstance,tr){var tableContainer=responsiveDatatablesHelperInstance.tableElement;var columns=tableContainer.fnSettings().aoColumns;var newTr=jQuery(responsiveDatatablesHelperInstance.rowTemplate);var ul=jQuery('ul',newTr);_.each(responsiveDatatablesHelperInstance.columnsHiddenIndexes,function(index){var rowIndex=tableContainer.fnGetPosition(tr[0]);var td=tableContainer.fnGetTds(rowIndex)[index];if(!responsiveDatatablesHelperInstance.options.hideEmptyColumnsInRowDetail||td.innerHTML.trim().length){var li=jQuery(responsiveDatatablesHelperInstance.rowLiTemplate);jQuery('.columnTitle',li).html(columns[index].sTitle);var rowHtml=jQuery(td).contents().clone();jQuery('.columnValue',li).html(rowHtml);li.attr('data-column',index);var tdClass=jQuery(td).attr('class');if(tdClass!=='undefined'&&tdClass!==false&&tdClass!==''){li.addClass(tdClass)}
ul.append(li);}});var colspan=responsiveDatatablesHelperInstance.columnIndexes.length-responsiveDatatablesHelperInstance.columnsHiddenIndexes.length;newTr.find('> td').attr('colspan',colspan);tr.after(newTr);};ResponsiveDatatablesHelper.prototype.hideRowDetail=function(responsiveDatatablesHelperInstance,tr){tr.next('.row-detail').find('li').each(function(){var tableContainer=responsiveDatatablesHelperInstance.tableElement;var aoData=tableContainer.fnSettings().aoData;var rowIndex=tableContainer.fnGetPosition(tr[0]);var column=jQuery(this).attr('data-column');var td=jQuery(this).find('span.columnValue').contents();aoData[rowIndex]._anHidden[column]=jQuery(aoData[rowIndex]._anHidden[column]).empty().append(td)[0];});tr.next('.row-detail').remove();};ResponsiveDatatablesHelper.prototype.disable=function(disable){this.disabled=(disable===undefined)||disable;if(this.disabled){this.setWindowsResizeHandler(false);jQuery('tbody tr.row-detail',this.tableElement).remove();jQuery('tbody tr',this.tableElement).removeClass('detail-show');jQuery('tbody tr span.responsiveExpander',this.tableElement).remove();this.columnsHiddenIndexes=[];this.columnsShownIndexes=this.columnIndexes;this.showHideColumns();this.tableElement.removeClass('has-columns-hidden');this.tableElement.off('click','span.responsiveExpander',this.showRowDetailEventHandler);}else{this.setWindowsResizeHandler();}}
jQuery.fn.dataTableExt.oApi.fnGetTds=function(oSettings,mTr)
{var anTds=[];var anVisibleTds=[];var iCorrector=0;var nTd,iColumn,iColumns;var iRow=(typeof mTr=='object')?oSettings.oApi._fnNodeToDataIndex(oSettings,mTr):mTr;var nTr=oSettings.aoData[iRow].nTr;for(iColumn=0,iColumns=nTr.childNodes.length;iColumn<iColumns;iColumn++){nTd=nTr.childNodes[iColumn];if(nTd.nodeName.toUpperCase()=="TD"){anVisibleTds.push(nTd);}}
for(iColumn=0,iColumns=oSettings.aoColumns.length;iColumn<iColumns;iColumn++){if(oSettings.aoColumns[iColumn].bVisible){anTds.push(anVisibleTds[iColumn-iCorrector]);}
else{anTds.push(oSettings.aoData[iRow]._anHidden[iColumn]);iCorrector++;}}
return anTds;};