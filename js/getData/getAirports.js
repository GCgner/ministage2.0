// Go on this website = https://airmundo.com/fr/aeroports/
// And put the code in the console
// Copy the ouput and put it in a SQL query to insert the data in a database

let countries = document.getElementsByClassName('airports_list__country');

let insert = '';

for(let element of countries){
    let country;
    let airports
    if(element.childElementCount === 2) {
        country = element.children[0].children[0].children[1].innerText;
        airports = element.children[1].children;
    }
    else {
        country = element.children[1].children[0].children[1].innerText;
        airports = element.children[2].children;
    }
     

    for(let element2 of airports){
        let city = element2.children[0].innerText;
        let data = '(\''+city+'\',\''+country+'\'),\n';
        insert = insert + data
        console.log(data);
    };
};
console.log(insert);