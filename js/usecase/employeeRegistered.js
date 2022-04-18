/*
 * CORE SCRIPT
*/

import repository from '../repository.js'

const regd = {
    generateChart: () => {
        let hostname = window.location.host
        let url = (hostname == 'localhost' ? window.location.origin + '/financecorp/Humanresource/getChart' : window.location.origin + '/Humanresource/getChart')

        repository.getRecord(url)
        .then(response => {
            helper.unblockUI()

            let chartPie = []
            let chartBar = []

            for (let key in response.pie) {
                chartPie.push({
                    "department": response.pie[key].DeptDes,
                    "value": response.pie[key].Total
                })
            }

            for (let key in response.bar) {
                chartBar.push({
                    "total": response.bar[key].Total,
                    "function": response.bar[key].WorkFunctionDes
                })
            }

            AmCharts.makeChart('chart_dashboardmain1', {
                "type": "pie",
                "theme": "light",
                "fontFamily": 'Open Sans',
                "color": '#333',
                "valueField": "value",
                "titleField": "department",
                "dataProvider": chartPie,
                "outlineAlpha": 0.5,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:20px'><b>[[value]] employee</b> ([[percents]]%)</span>",
                "angle": 30,
                "exportConfig": {
                    menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
                }
            });

            AmCharts.makeChart("chart_dashboardmain2", {
                "type": "serial",
                "theme": "light",
                "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                "autoMargins": true,
                // "marginLeft": 30,
                // "marginRight": 8,
                // "marginTop": 10,
                // "marginBottom": 26,
                "fontFamily": 'Open Sans',
                "color": '#333',
                "dataProvider": chartBar,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "graphs": [{
                    "title": "employee",
                    "type": "column",
                    "valueField": "total",
                    "alphaField": "alpha",
                    "balloonText": `<span style='font-size:20px;'>[[title]] total: <b>[[total]]</b> [[additional]]</span>`,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1
                }, {
                    "balloonText": `<span style='font-size:20px;'>[[title]] total: <b>[[total]]</b> [[additional]]</span>`,
                    "bullet": "round",
                    "dashLengthField": "dashLengthLine",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "function",
                    "valueField": "semester"
                }],
                "categoryField": "function",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                }
            });

            AmCharts.makeChart('chart_dashboardhrpie', {
                "type": "pie",
                "theme": "light",
                "fontFamily": 'Open Sans',
                "color": '#333',
                "valueField": "value",
                "titleField": "department",
                "dataProvider": chartPie,
                "outlineAlpha": 0.5,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:20px'><b>[[value]] employee</b> ([[percents]]%)</span>",
                "angle": 30,
                "exportConfig": {
                    menuItems: [{
                        icon: '/lib/3/images/export.png',
                        format: 'png'
                    }]
                }
            });

            AmCharts.makeChart("chart_dashboardhrbar", {
                "type": "serial",
                "theme": "light",
                "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                "autoMargins": true,
                // "marginLeft": 30,
                // "marginRight": 8,
                // "marginTop": 10,
                // "marginBottom": 26,
                "fontFamily": 'Open Sans',
                "color": '#333',
                "dataProvider": chartBar,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "graphs": [{
                    "title": "employee",
                    "type": "column",
                    "valueField": "total",
                    "alphaField": "alpha",
                    "balloonText": `<span style='font-size:20px;'>[[title]] total: <b>[[total]]</b> [[additional]]</span>`,
                    "dashLengthField": "dashLengthColumn",
                    "fillAlphas": 1
                }, {
                    "balloonText": `<span style='font-size:20px;'>[[title]] total: <b>[[total]]</b> [[additional]]</span>`,
                    "bullet": "round",
                    "dashLengthField": "dashLengthLine",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "function",
                    "valueField": "function"
                }],
                "categoryField": "function",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                }
            });
        })
        .fail(err => {
            helper.unblockUI()
            
            Swal.fire({
                'icon': 'error',
                'title': 'ABORTED',
                'html': `<h4 class="sbold">${err.responseJSON.desc ??= 'Server Problem'}</h4>`
            })
        })
    }
}

export default regd