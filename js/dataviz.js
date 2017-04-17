$(document).ready(function() {
    // Pas de cache sur les requête IMPORTANT !
    $.ajaxSetup({cache: false});

    /***
     On définit ici les fonctions de base qui vont nous servir à la récupération des données
     Je ne définis que le GET ici, mais il est possible d'utiliser POST pour récupérer ses données (on le verra dans un prochain TP)
     ****/
    function getRequest(url, callback) {
        $.get(url, function (data) {
            data = $.parseJSON(data);
            callback(data);
        });
    }

    var valeurs = [2, 3, 5, 8, 10];
    var legend = ['a', 'b', 'c', 'd'];


    //Fonction pour générer un Bar Chart
    function generateBarChart(idDiv, data)
    {
        $.jqplot.config.enablePlugins = true;

        var plot2 = $.jqplot(idDiv, [data],
            {
                title: 'Nombre de monstres tués classé par niveau du joueur',
                seriesDefaults:{
                    renderer:$.jqplot.BarRenderer,
                    rendererOptions:
                        {
                            barPadding: 1,
                            barMargin: 15,
                            barDirection: 'vertical',
                            barWidth: 50
                        },
                    pointLabels: { show: true }
                },
                axes: {
                    xaxis: {
                        renderer: $.jqplot.CategoryAxisRenderer,
                        ticks: ticks
                    }
                },
                highlighter: { show: false }
            });

        $(idDiv).bind('jqplotDataClick',
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    }



    // Fonction pour générer un Pie Chart (on peut entièrement paramétré le tout)
    // WARNING : Pour le reload, on doit stocker la référence (ici plot1), donc ce système de fonction ne peut pas marcher, il faudra le changer.
    // Je vous met cette fonction en exemple mais c'est une bonne pratique quand on utilise un modèle pour générer ses charts.
    function generatePieChart(idDiv, data)
    {
        // On génère l'exemple du TP :
        var plot1 = $.jqplot(idDiv, [data],
        {
            gridPadding: {top: 0, bottom: 38, left: 0, right: 0},
            seriesDefaults:
            {
                renderer: $.jqplot.PieRenderer,
                trendline: {show: false},
                rendererOptions: {padding: 8, showDataLabels: true, sliceMargin: 6, startAngle: -90}
            },
            legend:
            {
                show: true,
                placement: 'inside',
                rendererOptions: {numberRows: 3},
                location: 'ne',
                marginTop: '15px'
            }
        });
    }

    /***************************************
     EXEMPLE : PIE CHART : Visite par marque
     ****************************************/

    getRequest("php/repartition_nb_tues.php", function (data) {
		generateBarChart("monstretues", data);
    });

    getRequest("php/repartition_sexe_joueur.php", function (data) {
        generatePieChart("example", data);
	});

	getRequest("php/repartition_classes_jouees.php", function(data) {
		generatePieChart("classeJ", data);
	});
});