var public_vars=public_vars||{};jQuery.extend(public_vars,{breakpoints:{largescreen:[991,-1],tabletscreen:[768,990],devicescreen:[420,767],sdevicescreen:[0,419]},lastBreakpoint:null});function resizable(breakpoint)
{var sb_with_animation;if(is('largescreen'))
{sb_with_animation=public_vars.$sidebarMenu.find(".sidebar-collapse-icon").hasClass('with-animation')||public_vars.$sidebarMenu.hasClass('with-animation');if(public_vars.$sidebarMenu.data('initial-state')=='open')
{show_sidebar_menu(sb_with_animation);}
else
{hide_sidebar_menu(sb_with_animation);}}
if(ismdxl())
{public_vars.$mainMenu.attr('style','');}
if(is('tabletscreen'))
{sb_with_animation=public_vars.$sidebarMenu.find(".sidebar-collapse-icon").hasClass('with-animation')||public_vars.$sidebarMenu.hasClass('with-animation');hide_sidebar_menu(sb_with_animation);}
if(isxs())
{public_vars.$pageContainer.removeClass('sidebar-collapsed');}
jQuery(window).trigger('neon.resize');}
function get_current_breakpoint()
{var width=jQuery(window).width(),breakpoints=public_vars.breakpoints;for(var breakpont_label in breakpoints)
{var bp_arr=breakpoints[breakpont_label],min=bp_arr[0],max=bp_arr[1];if(max==-1)
max=width;if(min<=width&&max>=width)
{return breakpont_label;}}
return null;}
function is(screen_label)
{return get_current_breakpoint()==screen_label;}
function isxs()
{return is('devicescreen')||is('sdevicescreen');}
function ismdxl()
{return is('tabletscreen')||is('largescreen');}
function trigger_resizable()
{if(public_vars.lastBreakpoint!=get_current_breakpoint())
{public_vars.lastBreakpoint=get_current_breakpoint();resizable(public_vars.lastBreakpoint);}}