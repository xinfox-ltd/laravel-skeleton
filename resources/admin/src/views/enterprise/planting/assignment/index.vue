<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="计划名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="作业内容" prop="assignment_content" width="200"></el-table-column>
                <el-table-column label="计划" prop="planting_plan_name" width="200"></el-table-column>
                <el-table-column label="作业时间" prop="start_date" width="220">
                    <template #default="scope">
                        <el-tag>{{ scope.row.start_date }}</el-tag> - <el-tag>{{ scope.row.end_date }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="状态" prop="status" width="120"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="180"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="250">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" :loading="scope.row.$loading"
                                @click="inputList(scope.row)">资料图片</el-button>
                            <el-button text type="primary" size="small" :loading="scope.row.$loading"
                                @click="inputList(scope.row)">投入品</el-button>
                            <el-button text type="primary" size="small" :loading="scope.row.$loading"
                                @click="edit(scope.row)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row)">
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

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="refresh" @closed="dialog.save = false"></save-dialog>
    <el-drawer v-model="dialog.input" :size="900" :title="inputDrawerTitle" direction="rtl" destroy-on-close>
        <inputs ref="inputDialog" :assignmentId="currAssignmentId"></inputs>
    </el-drawer>
</template>

<script>
import saveDialog from './save'
import inputs from './input/list'
// import permissionDialog from './permission'

export default {
    name: 'role',
    components: {
        saveDialog,
        inputs
        // permissionDialog
    },
    data () {
        return {
            dialog: {
                save: false,
                input: false
            },
            inputDrawerTitle: "投入品",
            currAssignmentId: 0,
            list: {
                apiObj: this.$API.app.plantingAssignment.list,
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
                this.$refs.saveDialog.open()
            })
        },
        //编辑
        edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setData(row);
            })
        },

        inputList (row) {
            this.currAssignmentId = row.id
            this.inputDrawerTitle = row.planting_plan_name + "-投入品"
            this.dialog.input = true
        },

        //删除
        async del (row) {
            var reqData = { id: row.id }
            var res = await this.$API.demo.post.post(reqData);
            if (res.code == 200) {
                this.$refs.table.refresh()
                this.$message.success("删除成功")
            } else {
                this.$alert(res.message, "提示", { type: 'error' })
            }
        },

        //搜索
        upsearch () {
            this.$refs.table.upData(this.search);
        },

        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
