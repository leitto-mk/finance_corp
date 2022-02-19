
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

/**
 * Load Script as Interface
 */
const modules = {
    receipt: () => {
        /* List Page */
        rec.initDataTable()
        rec.eventShowList()
        rec.eventDeleteButton()

        /* Form Page */
        rec.initDisableEnterKey()
        rec.initSetEnterToFocus()
        rec.eventEnterToNextInput()
        rec.eventNextRow()
        rec.eventDeleteRow()
        rec.eventInputUnit()
        rec.eventChangeBranch()
        rec.eventChangeDepartment()
        rec.eventSubmitReceipt()
    },

    payment: () => {
        /* List Page */
        pay.initDataTable()
        pay.eventShowList()
        pay.eventDeleteButton()

        /* Form Page */
        pay.initDisableEnterKey()
        pay.initSetEnterToFocus()
        pay.eventNextRow()
        pay.eventDeleteRow()
        pay.eventInputUnit()
        pay.eventChangeBranch()
        pay.eventChangeDepartment()
        pay.eventSubmitPayment()
    },

    overbook: () => {
        /* List Page */
        ob.initDataTable()
        ob.eventShowList()
        ob.eventDeleteButton()

        /* Form Page */
        ob.initSetEnterToFocus()
        ob.eventNextRow()
        ob.eventDeleteRow()
        ob.eventInputUnit()
        ob.eventChangeBranch()
        ob.eventChangeDepartment()
        ob.eventSubmitOverbook()
    },

    generalJournal: () => {
        /* List Page */
        gj.initDataTable()

        /* Form Page */
        gj.initDisableEnterKey()
        gj.initSetEnterToFocus()
        gj.eventNextRow()
        gj.eventDeleteRow()
        gj.eventInputAmount()
        gj.eventChangeBranch()
        gj.eventChangeDepartment()
        gj.eventSubmitGeneral()
    },

    cashWithdraw: () => {
        /* List Page */
        caw.initDataTable()
        caw.eventShowList
        caw.eventDeleteButton

        /* Form Page */
        caw.initDisableEnterKey
        caw.initSetEnterToFocus
        caw.eventSelectEmployee
        caw.eventNextRow
        caw.eventDeleteRow
        caw.eventInputUnit
        caw.eventChangeBranch
        caw.eventChangeDepartment
        caw.eventSubmitCAWithdraw
    },

    cashReceipt: () => {
        /* List Page */
        car.initDataTable()
        car.eventShowList()
        car.eventDeleteButton()

        /* Form Page */
        car.initDisableEnterKey()
        car.initSetEnterToFocus()
        car.eventSelectEmployee()
        car.eventNextRow()
        car.eventDeleteRow()
        car.eventInputUnit()
        car.eventChangeBranch()
        car.eventChangeDepartment()
        car.eventSubmitCAReceipt()
    },

    cashPersonalStatement: () => {
        /* List Page  */
        cap.eventGetEmpDetails()
    },

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
        ics.eventSubmitFilter.eventChangeOption()
    },

    incomeStatementColumnar: () => {
        icsc.eventChangeOption()
        icsc.eventSubmitFilter()
    },
};

/* INITIALIZE CORE SCRIPT */
(function(){
    //Get Sript Name
    var fn = $('#script').attr('data-load-module')
    
    //Load Script
    if(fn in modules){
        modules[fn]()
    }else{
        console.log(`%cERROR: %cUnrecognised module of \`receipt\``,'color: red','color: white','color: yellow')
    }
})()