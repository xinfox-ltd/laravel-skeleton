<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="证书名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="证书类型" prop="type_label" width="150"></el-table-column>
                <el-table-column label="证书名称" prop="name" width="200"></el-table-column>
                <el-table-column label="证书编号" prop="certificate_no" width="150"></el-table-column>
                <el-table-column label="颁发机构" prop="authority" width="200"></el-table-column>
                <el-table-column label="证书图片" prop="images" width="300">
                    <template #default="scope">
                        <el-space wrap>
                            <el-image style="width: 50px; height: 50px" :src="item" :zoom-rate="1.2"
                                :preview-src-list="scope.row.scan_file" :initial-index="4"
                                v-for="(item, index) in scope.row.scan_file" :key="index" fit="cover"
                                :preview-teleported="true" />
                        </el-space>
                    </template>
                </el-table-column>
                <el-table-column label="添加时间" prop="created_at"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" @click="edit(scope.row)">编辑</el-button>
                            <el-button text type="primary" size="small" @click="authorize(scope.row)">授权</el-button>
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

    <el-drawer v-model="dialog.authorize" size="60%" title="授权" direction="rtl" destroy-on-close>
        <authorize ref="authorizeDrawer" :certificateId="certificateId"></authorize>
    </el-drawer>
</template>

<script>
import saveDialog from './save'
import authorize from './authorize/index'

export default {
    name: 'certificateList',
    components: {
        saveDialog,
        authorize
    },
    data () {
        return {
            dialog: {
                save: false,
                authorize: false
            },
            certificateId: 0,
            list: {
                apiObj: this.$API.app.certificate.list,
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

        authorize (row) {
            this.certificateId = row.id
            this.dialog.authorize = true
            // this.$nextTick(() => {
            //     this.$refs.authorizeDrawer.setData(row)
            // })
        },

        //删除
        async table_del (row) {
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
