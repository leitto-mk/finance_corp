import rec from './usecase/receipt.js'
import pay from './usecase/payment.js'
import ob from './usecase/overbook.js'
import gj from './usecase/generalJournal.js'
import caw from './usecase/cashWithdraw.js'
import car from './usecase/cashReceipt.js'
import cap from './usecase/cashPersonalStatement.js'
import gl from './usecase/generalLedger.js'
import bal from './usecase/balanceSheet.js'
import ics from  './usecase/incomeStatement.js'
import icsc from  './usecase/incomeStatementColumnar.js'
import jtr from './usecase/journalTransaction.js'

/**
 * Load Script as Interface
 */
const modules = {
    //* ENTRY
    receipt: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            rec.initDataTable()
            rec.eventShowList()
            rec.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            rec.initDisableEnterKey()
            rec.initSetEnterToFocus()
            rec.eventEnterToNextInput()
            rec.eventNextRow()
            rec.eventDeleteRow()
            rec.eventInputUnit()
            rec.eventChangeBranch()
            rec.eventChangeDepartment()
            rec.eventSubmitReceipt()
        }
    },

    payment: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            pay.initDataTable()
            pay.eventShowList()
            pay.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            pay.initDisableEnterKey()
            pay.initSetEnterToFocus()
            pay.eventNextRow()
            pay.eventDeleteRow()
            pay.eventInputUnit()
            pay.eventChangeBranch()
            pay.eventChangeDepartment()
            pay.eventSubmitPayment()
        }
    },

    overbook: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            ob.initDataTable()
            ob.eventShowList()
            ob.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            ob.initSetEnterToFocus()
            ob.eventNextRow()
            ob.eventDeleteRow()
            ob.eventInputUnit()
            ob.eventChangeBranch()
            ob.eventChangeDepartment()
            ob.eventSubmitOverbook()
        }
    },

    generalJournal: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            gj.initDataTable()
            gj.eventShowList()
            gj.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            gj.initDisableEnterKey()
            gj.initSetEnterToFocus()
            gj.eventNextRow()
            gj.eventDeleteRow()
            gj.eventInputAmount()
            gj.eventChangeBranch()
            gj.eventChangeDepartment()
            gj.eventSubmitGeneral()
        }
    },

    //* CASH ADVANCE
    cashWithdraw: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            caw.initDataTable()
            caw.eventShowList()
            caw.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            caw.initDisableEnterKey()
            caw.initSetEnterToFocus()
            caw.eventSelectEmployee()
            caw.eventNextRow()
            caw.eventDeleteRow()
            caw.eventInputUnit()
            caw.eventChangeBranch()
            caw.eventChangeDepartment()
            caw.eventSubmitCAWithdraw()
        }
    },

    cashReceipt: () => {
        let path = window.location.pathname
        let segment = path.split('/')[2]
        let page = segment.split('_')[0]

        if(page == 'view'){ /* List Page */
            car.initDataTable()
            car.eventShowList()
            car.eventDeleteButton()
        }else if(page == 'add' || page == 'edit'){ /* Form Page */
            car.initDisableEnterKey()
            car.initSetEnterToFocus()
            car.eventSelectEmployee()
            car.eventNextRow()
            car.eventDeleteRow()
            car.eventInputUnit()
            car.eventChangeBranch()
            car.eventChangeDepartment()
            car.eventSubmitCAReceipt()
        }
    },

    cashPersonalStatement: () => {
        cap.eventGetEmpDetails()
    },

    //* REPORTS
    generalLedger: () => {
        gl.eventPreviewFilter()
        gl.eventRecalculate()
    },

    balanceSheet: () => {
        bal.initGetURLParamAsFilter()
        bal.eventChangeOption()
        bal.eventSubmitFilter()
    },

    incomeStatement: () => {
        ics.eventChangeOption()
        ics.eventSubmitFilter()
    },

    incomeStatementColumnar: () => {
        icsc.eventChangeOption()
        icsc.eventSubmitFilter()
    },

    journalTransaction: () => {
        jtr.eventPreviewFilter()
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