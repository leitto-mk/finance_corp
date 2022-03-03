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

                if(page == 'view'){ /* List Page */
                    rec.indexPage.initDT()
                    rec.indexPage.eventShowList()
                    rec.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    rec.formPage.eventFocusNextInput()
                    rec.formPage.eventCreateRow()
                    rec.formPage.eventDeleteRow()
                    rec.formPage.eventInputUnit()
                    rec.formPage.eventChangeBranch()
                    rec.formPage.eventChangeDepartment()
                    rec.formPage.eventSubmitReceipt()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        payment: () => {
            import('./usecase/payment.js')
            .then(({default: pay}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    pay.indexPage.initDT()
                    pay.indexPage.eventShowList()
                    pay.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    pay.formPage.eventFocusNextInput()
                    pay.formPage.eventCreateRow()
                    pay.formPage.eventDeleteRow()
                    pay.formPage.eventInputUnit()
                    pay.formPage.eventChangeBranch()
                    pay.formPage.eventChangeDepartment()
                    pay.formPage.eventSubmitPayment()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        overbook: () => {
            import('./usecase/overbook.js')
            .then(({default: ob}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    ob.indexPage.initDT()
                    ob.indexPage.eventShowList()
                    ob.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    ob.formPage.eventFocusNextInput()
                    ob.formPage.eventCreateRow()
                    ob.formPage.eventDeleteRow()
                    ob.formPage.eventInputUnit()
                    ob.formPage.eventChangeBranch()
                    ob.formPage.eventChangeDepartment()
                    ob.formPage.eventSubmitOverbook()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        generalJournal: () => {
            import('./usecase/generalJournal.js')
            .then(({default: gj}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    gj.indexPage.initDT()
                    gj.indexPage.eventShowList()
                    gj.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    gj.formPage.eventFocusNextInput()
                    gj.formPage.eventCreateRow()
                    gj.formPage.eventDeleteRow()
                    gj.formPage.eventInputAmount()
                    gj.formPage.eventChangeBranch()
                    gj.formPage.eventChangeDepartment()
                    gj.formPage.eventSubmitGeneral()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        recalculateBalance: () => {
            import('./usecase/recalculateBalance.js')
            .then(({default: cal}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    cal.indexPage.eventRecalculateBranch()
                    cal.indexPage.eventRecalculateEmployee()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        //* CASH ADVANCE
        cashWithdraw: () => {
            import('./usecase/cashWithdraw.js')
            .then(({default: caw}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    caw.indexPage.initDT()
                    caw.indexPage.eventShowList()
                    caw.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    caw.formPage.eventFocusNextInput()
                    caw.formPage.eventSelectEmployee()
                    caw.formPage.eventCreateRow()
                    caw.formPage.eventDeleteRow()
                    caw.formPage.eventInputUnit()
                    caw.formPage.eventChangeBranch()
                    caw.formPage.eventChangeDepartment()
                    caw.formPage.eventSubmitCAWithdraw()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        cashReceipt: () => {
            import('./usecase/cashReceipt.js')
            .then(({default: car}) => {
                let path = window.location.pathname
                let segment = path.split('/')[2]
                let page = segment.split('_')[0]

                if(page == 'view'){ /* List Page */
                    car.indexPage.initDT()
                    car.indexPage.eventShowList()
                    car.indexPage.eventDeleteRecord()
                }else if(page == 'add' || page == 'edit'){ /* Form Page */
                    car.formPage.eventFocusNextInput()
                    car.formPage.eventSelectEmployee()
                    car.formPage.eventCreateRow()
                    car.formPage.eventDeleteRow()
                    car.formPage.eventInputUnit()
                    car.formPage.eventChangeBranch()
                    car.formPage.eventChangeDepartment()
                    car.formPage.eventSubmitCAReceipt()
                }
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        cashPersonalStatement: () => {
            import('./usecase/cashPersonalStatement.js')
            .then(({default: cap}) => {
                cap.indexPage.eventGetEmpDetails()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },

        outstandingReport: () => {
            import('./usecase/outstandingReport.js')
            .then(({default: our}) => {
                our.indexPage.eventGetOutstandingReport()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        cashTransactionDetail: () => {
            import('./usecase/cashTransactionDetail.js')
            .then(({default: ctd}) => {
                ctd.indexPage.eventGetCashTransactionDetail()  
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        //* REPORTS
        generalLedger: () => {
            import('./usecase/generalLedger.js')
            .then(({default: gl}) => {
                gl.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
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
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        incomeStatement: () => {
            import('./usecase/incomeStatement.js')
            .then(({default: ics}) => {
                ics.indexPage.eventChangeOption()
                ics.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        incomeStatementColumnar: () => {
            import('./usecase/incomeStatementColumnar.js')
            .then(({default: icsc}) => {
                icsc.indexPage.eventChangeOption()
                icsc.indexPage.eventSubmitFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
            })
        },
    
        journalTransaction: () => {
            import('./usecase/journalTransaction.js')
            .then(({default: jtr}) => {
                jtr.indexPage.eventPreviewFilter()
            })
            .catch(err => {
                console.log(`%cError:%c ${err}`, 'color: red')
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
