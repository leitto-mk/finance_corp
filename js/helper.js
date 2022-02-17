const eventSelectCurrency = () => {
    const API_KEY = 'efa820d81d9a4c6bb64b469e432b033e'
    
    fetch(`https://api.currencyfreaks.com/latest?apikey=${API_KEY}`)
        .then(response => response.json())
        .then(response => console.log(JSON.stringify(response, null, '\t')))
}

export default { eventSelectCurrency }