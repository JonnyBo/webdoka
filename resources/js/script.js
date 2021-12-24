const tabs = document.querySelector('.tabs');
const tabsBtn = document.querySelectorAll('.tabs__btn');
const tabsContent = document.querySelectorAll('.tabs__content');
if (tabs) {
    const tabsHandler = (path) => {
        tabsContent.forEach(el => {
            el.classList.remove('tabs__content--active')
        });
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('tabs__content--active');
        localStorage.setItem('guide', path);
    };

    document.addEventListener('DOMContentLoaded', () => {
        if (tabs) {
            tabs.addEventListener('click', (e) => {
                if (e.target.classList.contains('tabs__btn')) {
                    const tabsPath = e.target.dataset.tabsPath;
                    tabsBtn.forEach(el => {
                        el.classList.remove('tabs__btn--active')
                    });
                    document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('tabs__btn--active');
                    tabsHandler(tabsPath);
                }
            });

        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        let current = localStorage.getItem('guide');
        //const tabs = document.querySelector('.tabs');
        console.log(current);
        if (current) {
            tabsBtn.forEach(el => {
                el.classList.remove('tabs__btn--active')
            });
            document.querySelector(`[data-tabs-path="${current}"]`).classList.add('tabs__btn--active');
            tabsHandler(current);
        }


    });

}

