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
                <el-table-column label="序号" prop="serial_number" width="160"></el-table-column>
                <el-table-column label="验证码" prop="code" width="160"></el-table-column>
                <el-table-column label="有效期（天）" prop="effective_day" width="100"></el-table-column>
                <el-table-column label="启用日期" prop="enable_date" width="200"></el-table-column>
                <el-table-column label="失效日期" prop="expire_date" width="120"></el-table-column>
                <el-table-column label="产品" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="种植地块" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="采收计划" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="加工类型" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="开始加工日期" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="结束加工日期" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="外包装规格" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="等级" prop="valid_date[0]" width="120"></el-table-column>
                <el-table-column label="状态" prop="status" width="120">
                    <template #default="scope">
                        <el-tag type="info" v-if="scope.row.status == 1">{{ scope.row.status_label }}</el-tag>
                        <el-tag type="success" v-else-if="scope.row.status == 10">{{ scope.row.status_label }}</el-tag>
                        <el-tag type="danger" v-else>{{ scope.row.status_label }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="180"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" @click="qrcode(scope.row)">查看</el-button>
                            <el-popconfirm title="确定启用吗？" @confirm="operate('enable', scope.row)"
                                v-if="scope.row.status == 1 || scope.row.status == 2">
                                <template #reference>
                                    <el-button text type="primary" size="small">启用</el-button>
                                </template>
                            </el-popconfirm>
                            <el-popconfirm title="确定禁用吗？" @confirm="operate('disable', scope.row)"
                                v-if="scope.row.status == 10">
                                <template #reference>
                                    <el-button text type="danger" size="small">禁用</el-button>
                                </template>
                            </el-popconfirm>
                            <el-button text type="primary" size="small" @click="edit(scope.row)">编辑</el-button>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="refresh" @closed="dialog.save = false"></save-dialog>
    <qrcode-dialog v-if="dialog.qrcode" ref="qrcodeDialog" @success="refresh"
        @closed="dialog.qrcode = false"></qrcode-dialog>
</template>

<script>
import saveDialog from './save'
import qrcodeDialog from './qrcode'

export default {
    name: 'role',
    components: {
        saveDialog,
        qrcodeDialog
    },
    data () {
        return {
            dialog: {
                save: false,
                qrcode: false
            },
            list: {
                apiObj: this.$API.app.traceabilityCode.list,
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
                this.$refs.saveDialog.open('edit').setData(row)
            })
        },

        qrcode (row) {
            this.dialog.qrcode = true
            this.$nextTick(() => {
                this.$refs.qrcodeDialog.open().setData(row)
            })
        },

        //操作
        operate (action, row) {
            var reqData = { action }
            this.$API.app.traceabilityCode.operate.post(row.id, reqData).then(res => {
                if (res.code == 200) {
                    this.$refs.table.refresh()
                    this.$message.success("操作成功")
                } else {
                    this.$alert(res.message, "提示", { type: 'error' })
                }
            }).catch(() => {

            });

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
