<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="产品名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="产品名称" prop="name" width="150"></el-table-column>
                <el-table-column label="图片" prop="type_label" width="150"></el-table-column>
                <el-table-column label="产地" prop="origin" width="120"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="180"></el-table-column>
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

    <save-drawer v-if="dialog.save" ref="saveDrawer" @success="onSaveSuccess" @closed="dialog.save = false"></save-drawer>
</template>

<script>
import saveDrawer from './save'

export default {
    name: 'role',
    components: {
        saveDrawer,
    },
    data () {
        return {
            dialog: {
                save: false,
                // permission: false
            },

            list: {
                apiObj: this.$API.app.product.list,
            },
            search: {
                keyword: null
            }
        }
    },
    methods: {
        //添加
        add () {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDrawer.open()
            })
        },
        //编辑
        edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDrawer.open('edit').setData(row)
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
