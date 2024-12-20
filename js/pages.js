document.addEventListener('DOMContentLoaded', function () {
    const paginaAtual = window.location.pathname;

    if (paginaAtual === "/to-do%20list/pages/adicionar.php") {
        const adicionar = document.querySelector("#adicionar");
        adicionar.style.borderBottom = "3px solid blue";
    } else if (paginaAtual === "/to-do%20list/pages/quero_fazer.php") {
        const quero_fazer = document.querySelector("#querof");
        quero_fazer.style.borderBottom = "3px solid blue";
    } else if (paginaAtual === "/to-do%20list/pages/obrigado_fazer.php") {
        const obrigado_fazer = document.querySelector("#obrigadof");
        obrigado_fazer.style.borderBottom = "3px solid blue";
    } else if (paginaAtual === "/to-do%20list/pages/nao_fazer.php") {
        const nao_fazer = document.querySelector("#naofazer");
        nao_fazer.style.borderBottom = "3px solid blue";
    } else if (paginaAtual === "/to-do%20list/pages/feitos.php") {
        const feitos = document.querySelector("#feitos");
        feitos.style.borderBottom = "3px solid blue";
    } else if (paginaAtual === "/to-do%20list/pages/desativados.php") {
        const desativados = document.querySelector("#desativados");
        desativados.style.borderBottom = "3px solid blue";
    }

})