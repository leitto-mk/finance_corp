import helper from './helper.js'

$(document).ready(function(){
    /**
     * Load Script as Modules
     */
    const modules = {
        //* ENTRY
        receipt: baseUrl => {
            import('./usecase/receipt.js')
            .then(({default: rec}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        payment: baseUrl => {
            import('./usecase/payment.js')
            .then(({default: pay}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        overbook: baseUrl => {
            import('./usecase/overbook.js')
            .then(({default: ob}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        generalJournal: baseUrl => {
            import('./usecase/generalJournal.js')
            .then(({default: gj}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        recalculateBalance: baseUrl => {
            import('./usecase/recalculateBalance.js')
            .then(({default: cal}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
        arReceiptPayment: baseUrl => {
            import('./usecase/arReceiptPayment.js')
            .then(({default: arp}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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

        invoice: baseUrl => {
            let path = window.location.href
            let segment = path.split(baseUrl)[1]
            segment = segment.split('/')[1]
            segment = segment.toLowerCase()

            var req;
            switch (segment) {
                case 'new':
                    req = import('./usecase/invoiceForm.js')
                    .then(inv => {
                        inv.FormPage()
                    })
                    break;
                case 'edit':
                    req = import('./usecase/invoiceForm.js')
                    .then(inv => {
                        inv.FormPage()
                    })
                    break;
                case 'list':
                    req = import('./usecase/invoiceList.js')
                    .then(inv => {
                        inv.ListPage()
                    })
                    break;
                case 'aging':
                    req = import('./usecase/invoiceAging.js')
                    .then(inv => {
                        inv.AgingPage()
                    })
                    break;
            
                default:
                    req = import('./usecase/invoiceDashboard.js')
                    .then(inv => {
                        inv.DashboardPage()
                    })
                    
                    break;
            }

            req.catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* AP
        apPayment: baseUrl => {
            import('./usecase/apPayment.js')
            .then(({default: apy}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
        cashWithdraw: baseUrl => {
            import('./usecase/cashWithdraw.js')
            .then(({default: caw}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        cashReceipt: baseUrl => {
            import('./usecase/cashReceipt.js')
            .then(({default: car}) => {
                let path = window.location.href
                let segment = path.split(baseUrl)[1]
                segment = segment.split('/')[1]
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
    
        cashPersonalStatement: baseUrl => {
            import('./usecase/cashPersonalStatement.js')
            .then(({default: cap}) => {
                cap.indexPage.eventGetEmpDetails()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        outstandingReport: baseUrl => {
            import('./usecase/outstandingReport.js')
            .then(({default: our}) => {
                our.indexPage.eventGetOutstandingReport()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        cashTransactionDetail: baseUrl => {
            import('./usecase/cashTransactionDetail.js')
            .then(({default: ctd}) => {
                ctd.indexPage.eventGetCashTransactionDetail()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* EMPLOYEE
        employeeRegistered: baseUrl => {
            import('./usecase/employeeRegistered.js')
            .then(({default: regd}) => {
                regd.generateChart()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        newRegister: baseUrl => {},

        employeeGender: baseUrl => {},

        employeeType: baseUrl => {},

        employeeSupervisor: baseUrl => {},
    
        //* REPORTS
        generalLedger: baseUrl => {
            import('./usecase/generalLedger.js')
            .then(({default: gl}) => {
                gl.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        balanceSheet: baseUrl => {
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
    
        incomeStatement: baseUrl => {
            import('./usecase/incomeStatement.js')
            .then(({default: ics}) => {
                ics.indexPage.eventChangeOption()
                ics.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        incomeStatementColumnar: baseUrl => {
            import('./usecase/incomeStatementColumnar.js')
            .then(({default: icsc}) => {
                icsc.indexPage.eventChangeOption()
                icsc.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },
    
        journalTransaction: baseUrl => {
            import('./usecase/journalTransaction.js')
            .then(({default: jtr}) => {
                jtr.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })
        },

        //* MASTER
        master: baseUrl => {
            var path = window.location.href
            var segment = path.split(baseUrl)[1]

            //? OPERATION
            import('./usecase/masterOperation.js')
            .then(({default: mopr}) => {
                if(segment.toLowerCase() == 'cmaster'){
                    mopr.initTables()
                    mopr.eventAddNewItem()
                    mopr.eventEditItem()
                    mopr.eventDeleteItem()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red', 'color: white')
            })

            //? SUPPLY
            import('./usecase/masterSupply.js')
            .then(({default: msup}) => {
                if(segment.toLowerCase() == 'cmaster'){
                    msup.initTables()
                    msup.eventAddNewItem()
                    msup.eventEditItem()
                    msup.eventDeleteItem()
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

    //Get Base URL
    const baseURL = document.querySelector('#script').getAttribute('data-base-url')
    
    //Load Script
    if(fn in modules){
        modules[fn](baseURL)
    }else{
        console.log(`%cERROR: %cUnrecognised module of %c\`${fn}\``,'color: red','color: white','color: yellow')
    }

    //Resize Page
    helper.resizePage(0.9)
})
