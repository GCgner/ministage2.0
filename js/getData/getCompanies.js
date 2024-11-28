// Go on this website = https://www.airhelp.com/en-int/airhelp-score/airline-ranking/
// And put the code in the console
// Copy the ouput and put it in a SQL query to insert the data in a database

let companies = document.getElementsByTagName('tbody')[0].children;

let insert = '';

for(let company of companies) {
    let name = company.children[1].children[0].innerText;
    let data = '(\''+name+'\',\''+name.replaceAll(' ','_')+'.jpg\'),\n';
    insert = insert+data;
}

console.log(insert);