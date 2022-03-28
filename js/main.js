import helper from './helper.js'

$(document).ready(function(){
    /**
     * Load Script as Modules
     */
    const modules = {
        //* ENTRY
        receipt: () => {
            import('./usecase/receipt.js')
            .then(({default: rec}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    rec.indexPage.initDT()
                    rec.indexPage.eventShowList()
                    rec.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    rec.formPage.initInputMask()
                    rec.formPage.eventFocusNextInput()
                    rec.formPage.eventDeleteRow()
                    rec.formPage.eventInputUnit()
                    rec.formPage.eventChangeBranch()
                    rec.formPage.eventChangeDepartment()
                    rec.formPage.eventSubmitReceipt()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        payment: () => {
            import('./usecase/payment.js')
            .then(({default: pay}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    pay.indexPage.initDT()
                    pay.indexPage.eventShowList()
                    pay.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    pay.formPage.initInputMask()
                    pay.formPage.eventFocusNextInput()
                    pay.formPage.eventDeleteRow()
                    pay.formPage.eventInputUnit()
                    pay.formPage.eventChangeBranch()
                    pay.formPage.eventChangeDepartment()
                    pay.formPage.eventSubmitPayment()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        overbook: () => {
            import('./usecase/overbook.js')
            .then(({default: ob}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    ob.indexPage.initDT()
                    ob.indexPage.eventShowList()
                    ob.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    ob.formPage.initInputMask()
                    ob.formPage.eventFocusNextInput()
                    ob.formPage.eventDeleteRow()
                    ob.formPage.eventInputUnit()
                    ob.formPage.eventChangeBranch()
                    ob.formPage.eventChangeDepartment()
                    ob.formPage.eventSubmitOverbook()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        generalJournal: () => {
            import('./usecase/generalJournal.js')
            .then(({default: gj}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    gj.indexPage.initDT()
                    gj.indexPage.eventShowList()
                    gj.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    gj.formPage.initInputMask()
                    gj.formPage.eventFocusNextInput()
                    gj.formPage.eventDeleteRow()
                    gj.formPage.eventInputAmount()
                    gj.formPage.eventChangeBranch()
                    gj.formPage.eventChangeDepartment()
                    gj.formPage.eventSubmitGeneral()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        recalculateBalance: () => {
            import('./usecase/recalculateBalance.js')
            .then(({default: cal}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    cal.indexPage.eventRecalculateBranch()
                    cal.indexPage.eventRecalculateEmployee()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* AR
        arReceiptPayment: () => {
            import('./usecase/arReceiptPayment.js')
            .then(({default: arp}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    arp.indexPage.initDT()
                    arp.indexPage.eventShowList()
                    arp.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    arp.formPage.initInputMask()
                    arp.formPage.eventFocusNextInput()
                    arp.formPage.eventDeleteRow()
                    arp.formPage.eventInputUnit()
                    arp.formPage.eventChangeBranch()
                    arp.formPage.eventChangeDepartment()
                    arp.formPage.eventSubmitARReceiptPayment()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        invoice: () => {
            import('./usecase/invoice.js')
            .then(({default: inv}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == ""){
                    inv.dashboardPage.generateDataTable()
                }else if(page.toLowerCase() == "create_invoice"){
                    inv.formPage
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* AP
        apPayment: () => {
            import('./usecase/apPayment.js')
            .then(({default: apy}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    apy.indexPage.initDT()
                    apy.indexPage.eventShowList()
                    apy.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    apy.formPage.initInputMask()
                    apy.formPage.eventFocusNextInput()
                    apy.formPage.eventInputUnit()
                    apy.formPage.eventChangeBranch()
                    apy.formPage.eventChangeDepartment()
                    apy.formPage.eventSubmitARReceiptPayment()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        //* CASH ADVANCE
        cashWithdraw: () => {
            import('./usecase/cashWithdraw.js')
            .then(({default: caw}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    caw.indexPage.initDT()
                    caw.indexPage.eventShowList()
                    caw.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    caw.formPage.initInputMask()
                    caw.formPage.eventFocusNextInput()
                    caw.formPage.eventSelectEmployee()
                    caw.formPage.eventDeleteRow()
                    caw.formPage.eventInputUnit()
                    caw.formPage.eventChangeBranch()
                    caw.formPage.eventChangeDepartment()
                    caw.formPage.eventSubmitCAWithdraw()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        cashReceipt: () => {
            import('./usecase/cashReceipt.js')
            .then(({default: car}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page.toLowerCase() == 'view'){ /* List Page */
                    car.indexPage.initDT()
                    car.indexPage.eventShowList()
                    car.indexPage.eventDeleteRecord()
                }else if(page.toLowerCase() == 'add' || page.toLowerCase() == 'edit'){ /* Form Page */
                    car.formPage.initInputMask()
                    car.formPage.eventFocusNextInput()
                    car.formPage.eventSelectEmployee()
                    car.formPage.eventDeleteRow()
                    car.formPage.eventInputUnit()
                    car.formPage.eventChangeBranch()
                    car.formPage.eventChangeDepartment()
                    car.formPage.eventSubmitCAReceipt()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        cashPersonalStatement: () => {
            import('./usecase/cashPersonalStatement.js')
            .then(({default: cap}) => {
                cap.indexPage.eventGetEmpDetails()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        outstandingReport: () => {
            import('./usecase/outstandingReport.js')
            .then(({default: our}) => {
                our.indexPage.eventGetOutstandingReport()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        cashTransactionDetail: () => {
            import('./usecase/cashTransactionDetail.js')
            .then(({default: ctd}) => {
                ctd.indexPage.eventGetCashTransactionDetail()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* EMPLOYEE
        employee: () => {
            $.get('getChart')
            .then(data => {
                data = JSON.parse(data)
                let chartPie = []
                let chartBar = []

                for (let key in data.pie) {
                    chartPie.push({
                        "department": data.pie[key].DeptDes,
                        "value": data.pie[key].Total
                    })
                }

                for (let key in data.bar) {
                    chartBar.push({
                        "total": data.bar[key].Total,
                        "function": data.bar[key].WorkFunctionDes
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
        },
    
        //* REPORTS
        generalLedger: () => {
            import('./usecase/generalLedger.js')
            .then(({default: gl}) => {
                gl.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        balanceSheet: () => {
            import('./usecase/balanceSheet.js')
            .then(({default: bal}) => {
                bal.indexPage.initGetURLParamAsFilter()
                bal.indexPage.eventChangeOption()
                bal.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        incomeStatement: () => {
            import('./usecase/incomeStatement.js')
            .then(({default: ics}) => {
                ics.indexPage.eventChangeOption()
                ics.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        incomeStatementColumnar: () => {
            import('./usecase/incomeStatementColumnar.js')
            .then(({default: icsc}) => {
                icsc.indexPage.eventChangeOption()
                icsc.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        journalTransaction: () => {
            import('./usecase/journalTransaction.js')
            .then(({default: jtr}) => {
                jtr.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* MASTER
        master: () => {
            var path = window.location.pathname
            var segment = path.split('/')[1]

            //? OPERATION
            import('./usecase/masterOperation.js')
            .then(({default: mopr}) => {
                if(segment.toLowerCase() == 'cmaster'){
                    mopr.stockgorup.initTables()
                    mopr.stockgorup.eventAddNewItem()
                    mopr.stockgorup.eventEditItem()
                    mopr.stockgorup.eventDeleteItem()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })

            //? SUPPLY
            import('./usecase/masterSupply.js')
            .then(({default: msup}) => {
                if(segment.toLowerCase() == 'cmaster'){
                    msup.stockgorup.initTables()
                    msup.stockgorup.eventAddNewItem()
                    msup.stockgorup.eventEditItem()
                    msup.stockgorup.eventDeleteItem()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })

            //? FINANCE
            import('./usecase/masterFinance.js')
            .then(({default: mfin}) => {
                if(segment.toLowerCase() == 'c_finance'){
                    mfin.coa.eventOpenModalNewHeading()
                    mfin.coa.eventEditHeading()
                    mfin.coa.eventSubmitNewHeading()
                    mfin.coa.eventDeleteHeading()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        }
    };
    
    //Get Sript Name
    const fn = document.querySelector('#script').getAttribute('data-load-module')
    
    //Load Script
    if(fn in modules){
        modules[fn]()
    }else{
        console.log(`%cERROR: %cUnrecognised module of %c\`${fn}\``,'color: red','color: white','color: yellow')
    }

    //Resize Page
    helper.resizePage(0.9)
})
