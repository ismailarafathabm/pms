<style>
    .gen_autocompleate {
        position: absolute;
        margin-left: -9px;
        margin-top: -30px;
        z-index: 5;
    }

    .autocompleate-dia {
        position: fixed;
        width: 600px;
        background-color: #fff;
        border-radius: 10px;
        padding: 10px;
        border: 1px solid #dbdbdb;
        height: 400px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .autocompleate-container {
        display: block;
        background: #fff;
        margin-bottom: 5px;
        width: 100%;
    }

    .autocompleate-loads {
        position: relative;
        height: 100%;
        overflow: auto;
    }

    .autocompleate-table {
        position: relative;
        border-collapse: collapse;
        width: 100%;
    }

    .autocompleate-table th {
        border: 1px solid #d3d3d3;
        font-size: 13px;

    }

    .autocompleate-table td {
        font-size: 12px;
    }

    .xtable {
        position: relative;
        border-collapse: collapse;
    }

    .xtable th {
        border: 1px solid #d3d3d3;
        font-size: 1rem;
        padding: 5px;
        background: #d2e3e5;

    }

    .xtable td {
        font-size: 1rem;
        border: 1px solid #d3d3d3;
        padding: 5px;
    }

    @media (max-width: 1200px) {
        .autocompleate-dia {
            max-height: 220px;
            overflow: none;
        }
    }
</style>