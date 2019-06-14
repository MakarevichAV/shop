class Product {
    // Данные
    constructor (productName, productPic, productPrice, productID) {
        this.name = productName;
        this.pic = productPic;
        this.price = productPrice;
        this.id = productID;
        this.el = document.querySelector('.goods');
    }
    // Действия с данными  // Методы
    createCard() {
        let card = document.createElement('div');
        card.classList.add('product');
        card.innerHTML = `
            <a href="/pages/details.php?id=${this.id}" class="product-img" style="background-image: url(/images/catalog/${this.pic})"></a>
            <a href="/pages/details.php?id=${this.id}" class="product-name">${this.name}</a>
            <p class="price"><span>${this.price}</span> руб.</p>
            <div class="submit padding10 pointer font-size bg-orange txt-color-white" data-id="${this.id}">Добавить в корзину</div>
        `;
        this.el.appendChild(card);
    }
}

class Catalog {
    constructor () {
        this.el = document.querySelector('.goods');
    }
    cleanCatalog() {
        this.el.innerHTML = '';
    }
    preloaderOn() {
        let preloader = document.createElement('div');
        preloader.classList.add('preloader');
        this.el.appendChild(preloader);
    }
    preloaderOff() {
        this.cleanCatalog();
    }
    addToCard() {
        // Найти все кнопки
        let buttons = document.querySelectorAll('.submit');

        // Циком добавиь обработчик события клик
        buttons.forEach( function (val, ind) {
            
            val.addEventListener( 'click', function () {

                let dataID = val.getAttribute('data-id');     // setAttribute('Имя аттр', 'значение' ) - Установить (добавить) аттрибут

                //AJAX
                // 1. Создаем пустой объект
                let xhr = new XMLHttpRequest;

                // 2. Наполняем его данными для отправки
                xhr.open('GET', `/handlers/addToCard.php?id=${dataID}`);
           
                // 3. Отправляем данные
                xhr.send();
                
                // 4. Ждем ответ от сервера   // () => для подтягивания контекста, чтобы работал this внутри обработчика
                xhr.addEventListener('load', () => {
                    let data = JSON.parse(xhr.responseText);
                    alert(data);
                });
           
            } );

        } );

        // При клике в обработчике: 
            // 1. получить данные из атрибута data-id
            // 2. отправить их в файл addToCard.php
    }
    renderPagination(allPages, currentPage, catID) {   // метод для вывода кубиков пагинации  // подставляется количество кубиков и номер активного кубика
        // console.log(currentPage)
        let contentNav = document.querySelector('.content-nav');
        contentNav.innerHTML = '';
        

        let i = 0;
        while (i < allPages) {
            i++;
            let pageElement = document.createElement('div');
            pageElement.classList.add('content-nav-item');
            pageElement.innerHTML = `${i}`;
            if ( i == currentPage ) {
                pageElement.classList.add('opened');
            }
            

            pageElement.addEventListener( 'click', function () {
                let innerText = this.innerText;
                catalog.renderCatalog( catID, innerText );
            } );
            contentNav.appendChild(pageElement);
        }
    }
    // renderSizes(size) {
    //     let selectSizes = document.querySelector('.sizes');
    //     selectSizes.innerHTML = '';

    // }
    renderCatalog(subCatId, currentPage) {

        this.cleanCatalog();
        this.preloaderOn();

        // 1. Создаем пустой объект
        let xhr = new XMLHttpRequest;

        // проверка есть ли GET параметры в строке
        // тернарный оператор (вместо if else) 
        let catID = (window.location.search == '') ? '?id=1' : window.location.search ;


        let curPage;
        // Проверяем на наличие currentPage
        if (currentPage != undefined) {
            curPage = currentPage;
        } else {
            curPage = 1;
        }


        if (subCatId != undefined) {
            catID = `?id=${subCatId}`;
        }
        // console.log(currentPage);
        // 2. Наполняем его данными для отправки
        xhr.open('GET', `/handlers/catalogHandler.php${catID}&page=${curPage}`);

        // 3. Отправляем данные
        xhr.send();

        // 4. Ждем ответ от сервера   // () => для подтягивания контекста, чтобы работал this внутри обработчика
        xhr.addEventListener('load', () => {
            
            this.preloaderOff();
        
            let data = JSON.parse(xhr.responseText);   // в дате будет находиться объект с данными о погинации и товарами
            // console.log(data);
            // выводим карточки товаров на основании полученных данных
            data.items.forEach( function (value, index) {                // data.items - товары
                let newCard = new Product(value.name, value.pic, value.price, value.id);
                newCard.createCard();
            } );
            this.addToCard();
            this.renderPagination(data.pagination.allPages, data.pagination.currentPage, subCatId);
            // console.log(data.pagination.currentPage);
        });

    }
}

let catalog = new Catalog();
catalog.renderCatalog();


let catalogSelect = document.querySelectorAll('.subcat');

// console.log(catalogSelect);
catalogSelect.forEach( function (v, i) {
    v.addEventListener('change', function () {
        // alert('подкатегория выбрана');
        
        // получаем значение выбранного инпута radio
        let selectValue = v.value;
        
        // создаем новый экземпляр объекта Catalog 
        let catalog = new Catalog();
        catalog.renderCatalog( selectValue );
                                                            // Добавить смену подзаголовка!!!

    });
} );