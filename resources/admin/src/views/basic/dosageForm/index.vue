<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">

                <div class="right-panel-search">
                    <el-space wrap>
                        <el-input v-model="search.keyword" placeholder="剂型名称" clearable></el-input>
                        <el-select v-model="search.category_id" clearable placeholder="类别">
                            <el-option v-for="item in inputCategoryOptions" :key="item.id" :label="item.name"
                                :value="item.id" />
                        </el-select>
                        <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                    </el-space>
                </div>

            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="剂型名称" prop="name" width="150"></el-table-column>
                <el-table-column label="投入品类别" prop="category.name" width="200"></el-table-column>
                <el-table-column label="备注" prop="remark" width="200"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="200"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small"
                                @click="edit(scope.row, scope.$index)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row, scope.$index)">
                                <template #reference>
                                    <el-button text type="primary" size="small">删除</el-button>
                                </template>
                            </el-popconfirm>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="onSaveSuccess" @closed="dialog.save = false"></save-dialog>
</template>

<script>
import saveDialog from './save'

export default {
    name: 'role',
    components: {
        saveDialog,
    },
    data () {
        return {
            dialog: {
                save: false,
                // permission: false
            },
            inputCategoryOptions: [],
            list: {
                apiObj: this.$API.app.dosageForm.list,
            },
            search: {
                keyword: null
            }
        }
    },
    mounted () {
        this.getInputCategoryOptions();
    },
    methods: {
        //添加
        add () {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open()
            })
        },
        getInputCategoryOptions () {
            this.$API.app.inputCategory.list.get({ pagination: false })
                .then(res => {
                    this.inputCategoryOptions = res.data.rows
                })
        },
        //编辑
        edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setData(row)
            })
        },

        //搜索
        upsearch () {
            this.$refs.table.upData(this.search);
        },

        onSaveSuccess () {
            this.refresh();
        },
        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
