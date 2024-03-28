<script setup>
import { ref, onMounted, defineProps } from "vue";

const props = defineProps({
    initialData: Object,
    saveData: Function,
});
const tableEditor = ref(null);
const tableHead = ref(null);
const tableBody = ref(null);
const tableData = ref({
    columns: [],
    rows: [],
});
const columnCount = ref(0);
const rowCount = ref(0);

const createInput = (rowIndex, columnIndex, isHeader) => {
    const input = document.createElement("input");
    input.classList.add("input", "input-sm", "w-full", "input-bordered");

    if (isHeader) {
        input.value = tableData.value.columns[columnIndex] || "";
    }
    if (!isHeader) {
        input.value = tableData.value.rows[rowIndex][columnIndex] || "";
    }

    input.setAttribute("data-row-index", rowIndex);
    input.setAttribute("data-column-index", columnIndex);

    input.onchange = (event) => {
        const index = event.target.getAttribute("data-row-index");
        const dataIndex = isHeader ? "columns" : "rows";
        if (isHeader) {
            tableData.value[dataIndex][
                Number(event.target.getAttribute("data-column-index"))
            ] = event.target.value;
            props.saveData(tableData.value);
            return;
        }

        tableData.value[dataIndex][Number(index)][
            Number(event.target.getAttribute("data-column-index"))
        ] = event.target.value;
        props.saveData(tableData.value);
    };

    return input;
};

const createCell = (rowIndex, columnIndex, isHeader) => {
    const td = document.createElement("td");
    const input = createInput(rowIndex, columnIndex, isHeader);
    td.appendChild(input);
    return td;
};

const addColumn = () => {
    const th = document.createElement("th");
    const input = createInput(0, columnCount.value, true);

    columnCount.value += 1;
    th.classList.add("min-w-[100px]");
    th.appendChild(input);
    tableHead.value.insertBefore(
        th,
        tableHead.value.children[columnCount.value - 1]
    );

    updateTableBody();
};

const addRow = () => {
    tableData.value.rows = [...tableData.value.rows, []];
    const tableRow = document.createElement("tr");
    const firstTd = document.createElement("td");
    tableRow.appendChild(firstTd);

    for (let i = 0; i < columnCount.value; i++) {
        const td = createCell(rowCount.value, i, false);
        tableRow.insertBefore(td, tableRow.children[i]);
    }

    tableBody.value.appendChild(tableRow);
    rowCount.value += 1;
};

const updateTableBody = () => {
    const tableBodyRows = tableBody.value.querySelectorAll("tr");
    tableBodyRows.forEach((row, index) => {
        const td = document.createElement("td");
        const input = createInput(index, columnCount.value - 1, false);
        td.appendChild(input);
        row.insertBefore(td, row.children[row.children.length - 1]);
    });
};

onMounted(() => {
    if (props.initialData) {
        tableData.value = props.initialData;
        tableData.value.columns.forEach(() => {
            addColumn();
        });
        tableData.value.rows.forEach(() => addRow());
        tableData.value.rows.pop();
    }
});
</script>

<template>
    <div class="overflow-x-scroll">
        {{ tableData }}
        <table class="table min-w-full" ref="tableEditor">
            <thead class="bg-slate-50">
                <tr ref="tableHead">
                    <th class="w-[5%]">
                        <button
                            class="btn btn-sm btn-outline"
                            title="tambah kolom"
                            type="button"
                            @click="addColumn"
                        >
                            +
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody ref="tableBody"></tbody>
            <tfoot>
                <tr>
                    <td>
                        <button
                            type="button"
                            class="btn btn-sm"
                            title="tambah baris"
                            @click="addRow"
                        >
                            +
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>
