import rec from './usecase/receipt.js'
import pay from './usecase/payment.js'
import ob from './usecase/overbook.js'
import gj from './usecase/generalJournal.js'
import gj from './usecase/recalculateBalance.js'
import caw from './usecase/cashWithdraw.js'
import car from './usecase/cashReceipt.js'
import cap from './usecase/cashPersonalStatement.js'
import our from './usecase/outstandingReport.js'
import ctd from './usecase/cashTransactionDetail.js'
import gl from './usecase/generalLedger.js'
import bal from './usecase/balanceSheet.js'
import ics from  './usecase/incomeStatement.js'
import icsc from  './usecase/incomeStatementColumnar.js'
import jtr from './usecase/journalTransaction.js'
/**
 * Load Script as Modules
 */
const modules = {
    //* ENTRY
    receipt: () => {
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
    },

    payment: () => {
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
    },

    overbook: () => {
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
    },

    generalJournal: () => {
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
    },

    recalculateBalance: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            cal.indexPage.eventRecalculateBranch()
            cal.indexPage.eventRecalculateEmployee()
        }
    },

    //* CASH ADVANCE
    cashWithdraw: () => {
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
    },

    cashReceipt: () => {
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
    },

    cashPersonalStatement: () => {
        cap.indexPage.eventGetEmpDetails()
    },

    outstandingReport: () => {
        our.indexPage.eventGetOutstandingReport()
    },

    cashTransactionDetail: () => {
        ctd.indexPage.eventGetCashTransactionDetail()
    },

    //* REPORTS
    generalLedger: () => {
        gl.indexPage.eventPreviewFilter()
        gl.indexPage.eventRecalculate()
    },

    balanceSheet: () => {
        bal.indexPage.initGetURLParamAsFilter()
        bal.indexPage.eventChangeOption()
        bal.indexPage.eventSubmitFilter()
    },

    incomeStatement: () => {
        ics.indexPage.eventChangeOption()
        ics.indexPage.eventSubmitFilter()
    },

    incomeStatementColumnar: () => {
        icsc.indexPage.eventChangeOption()
        icsc.indexPage.eventSubmitFilter()
    },

    journalTransaction: () => {
        jtr.indexPage.eventPreviewFilter()
    }
};

//Get Sript Name
var fn = document.querySelector('#script').getAttribute('data-load-module')

//Load Script
if(fn in modules){
    modules[fn]()
}else{
    console.log(`%cERROR: %cUnrecognised module of %c\`${fn}\``,'color: red','color: white','color: yellow')
}