require.config({
	baseUrl : baseAsset,
	shim : {
		'customIndex' : {
			deps: ['jquery']
		},
		'customDemo' : {
			deps: ['jquery']
		},
		'bootstrap' : {
			deps: ['jquery']
		},
		'jquerySparkiLines' : {
			deps: ['jquery']
		},
		'jquerySlimscroll' : {
			deps: ['jquery']
		},
		'morris' : {
			deps: ['jquery']
		},
		'leanmodal' : {
			deps: ['jquery']
		},
		'customAdmin' : {
			deps: ['jquery']
		},
		'customIndex' : {
			deps: ['jquery']
		},
		'sweetAlert' : {
			deps: ['jquery', 'customDemo']
		},
		'jqueryForm' : {
			deps: ['jquery']
		},
		'profile' : {
			deps: ['jquery']
		},
		'menu' : {
			deps: ['jquery']
		},
		'group' : {
			deps: ['jquery']
		}
	},
	paths : {
		jquery            : 'plugins/jquery/jquery.min',
		bootstrap         : 'plugins/bootstrap/js/bootstrap',
		bootstrapSelect   : 'plugins/bootstrap-select/js/bootstrap-select',
		jquerySlimscroll  : 'plugins/jquery-slimscroll/jquery.slimscroll',
		waves             : 'plugins/node-waves/waves',
		jqueryCountTo     : 'plugins/jquery-countto/jquery.countTo',
		raphael           : 'plugins/raphael/raphael.min',
		morris            : 'plugins/morrisjs/morris',
		bundle            : 'plugins/chartjs/Chart.bundle',
		jquerySparkiLines : 'plugins/jquery-sparkline/jquery.sparkline',
		sweetAlert 		: 'plugins/sweetalert/sweetalert.min',
		customAdmin       : 'js/admin',
		customIndex       : 'js/pages/index',
		customDemo        : 'js/demo',
        method            : 'js/method',
        jquerydatatables  : 'plugins/jquery-datatable/jquery.dataTables',
        leanmodal  : 'plugins/jquery-leanmodal/jquery.leanModal.min',
        jqueryForm  : 'plugins/form/jqueryForm',
        profile  : 'js/profile/profile',
		menu 	: 'js/menu/menu',
		group 	: 'js/group/group',
	}
});
