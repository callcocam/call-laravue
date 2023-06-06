<template>
    <div class="grid grid-cols-4 gap-2">
        <div class="left-board">
            <div class="logo-wrapper">
                <div class="logo flex w-full items-center justify-between">
                   Form Generator
                    <a class="avatar w-8 h-8" href="https://github.com/yupk/form-generator-vue3" target="_blank">
                        <img class="avatar w-8 h-8" src="https://github.githubassets.com/pinned-octocat.svg" alt />
                    </a>
                </div>
            </div>
            <el-scrollbar class="left-scrollbar">
                <!-- {{generate(settings)}} -->

                <page-panel @addComponent="(el) => {
                    settings.drawingList.push(el);
                }
                    "></page-panel>

                <div class="components-list"></div>
            </el-scrollbar>
        </div>

        <div class="flex">
            <div class="flex items-center justify-between">
                <div class="btn" @click="preViewCode">
                    <el-icon>
                        <video-play />
                    </el-icon>generate
                </div>
                <div class="btn" @click="clearn()">
                    <el-icon>
                        <delete />
                    </el-icon>empty
                </div>

                <div class="btn">
                    <el-switch v-model="device" active-text="computer mode" inactive-text="phone mode" active-value="pc"
                        inactive-value="mobile" />
                </div>
                <div class="btn">
                    <el-switch v-model="preview" active-text="development mode" inactive-text="preview mode" active-value=""
                        inactive-value="preview" />

                </div>
            </div>
            <el-scrollbar class="center-scrollbar" :class="[device, preview]">
                <page-drawer :model-value="settings" @update:model-value="update"></page-drawer>
            </el-scrollbar>
        </div>

        <page-setting :model-value="settings" @update:model-value="update" style="padding-left: 10px"></page-setting>
    </div>

    <el-drawer v-model="showCode" direction="rtl" size="50%" style="height:100%">
        <template #header>
            <div class="preview-action-bar">
                <div class="btn" @click="execDownload('test.vue')">
                    <el-icon>
                        <download />
                    </el-icon>download code
                </div>

                <div class="btn" @click="ClipboardWrite()">
                    <el-icon>
                        <document-copy />
                    </el-icon>copy code
                </div>
            </div>
        </template>
        <el-scrollbar height="600px" v-highlight>
            <pre>
          <code> {{ generate(settings) }}</code>
      </pre>
        </el-scrollbar>
    </el-drawer>
</template>
  
<script>
import PageDrawer from "./PageDrawer.vue";
import PagePanel from "./PagePanel.vue";
import PageSetting from "./PageSetting.vue";
import useClipboard from 'vue-clipboard3';

import { ElMessage } from 'element-plus';

import { saveAs } from "file-saver";

import {
    deepClone,
    findEle,
    isObjectArray,
    randFieldId,
} from "./../../utils/func.js";
import { formConf } from "./ui/index";
import { generate } from "./../../utils/generate.js";
import {
    Iphone,
    Monitor,
    VideoPlay,
    Delete,
    Download,
    DocumentCopy
} from "@element-plus/icons-vue";
import { defineComponent, provide, reactive, ref, watch } from "vue";

export default defineComponent({
    name: "PageGenerator",
    props: {},
    components: {
        PagePanel,
        PageDrawer,
        PageSetting,
        DocumentCopy,
        Iphone,
        Monitor,
        VideoPlay,
        Delete,
        Download,
    },

    setup(props) {
        const device = ref("pc");
        const showCode = ref(false);
        const preview = ref("");
        const loadSetting = function () {
            let strs = localStorage.getItem("settings");
            if (strs) {
                return JSON.parse(strs);
            }

            return {
                current: "",
                formConf: formConf,
                drawingList: [],
            };
        };
        const settings = reactive(loadSetting());

        const update = function (e) {
            settings.formConf = e.formConf;
            settings.drawingList = e.drawingList;
        };

        const selected = function (s) {
            settings.current = s;
        };

        const clearn = function () {
            localStorage.removeItem("settings");

            settings.current = "";
            settings.formConf = formConf;
            settings.drawingList = [];
        };

        /**
         * 选中高亮亮
         */
        const hightLight = function (s) {
            if (settings.current == s) {
                return { border: "1px solid #ffc92fde", backgroundColor: "#e4ff0024" };
            }
            return {};
        };

        const _del = function (items, _id) {
            for (let item of items) {
                if (item.__ID == _id) {
                    items.splice(items.indexOf(item), 1);
                    return true;
                } else if (isObjectArray(item.childrens)) {
                    if (_del(item.childrens, _id)) {
                        return true;
                    }
                }
            }
        };

        const deleteItem = function (_id) {
            _del(settings.drawingList, _id);
        };

        const _copy = function (items, _id) {
            for (let item of items) {
                if (item.__ID == _id) {
                    const newItem = deepClone(item);
                    newItem.__ID = randFieldId();
                    items.push(reactive(newItem));
                    return true;
                } else if (isObjectArray(item.childrens)) {
                    if (_copy(item.childrens, _id)) {
                        return true;
                    }
                }
            }
        };

        const copyItem = function (_id) {
            _copy(settings.drawingList, _id);
        };

        const updateChild = function (eles, ids) {
            let item = findEle(settings.drawingList, ids);

            item.childrens = eles;
        };

        const updateDefaultValue = function (val, ids) {
            let item = findEle(settings.drawingList, ids);

            item.defaultvalue = val;
        };

        const execDownload = function (filename) {
            const codeStr = generate(settings);
            const blob = new Blob([codeStr], {
                type: "text/plain;charset=utf-8",
            });
            saveAs(blob, filename);
        };

        const preViewCode = function () {

            showCode.value = true;

        }

        const { toClipboard } = useClipboard()

        const ClipboardWrite = async () => {

            const codeStr = generate(settings);
            try {
                await toClipboard(codeStr);
                ElMessage("复制成功！")
                console.log('Copied to clipboard')
            } catch (e) {
                console.error(e)
            }
        }
        watch(settings, () => {
            console.log(settings);
            localStorage.setItem("settings", JSON.stringify(settings));
        });

        provide("copyItem", copyItem);
        provide("deleteItem", deleteItem);
        provide("selected", selected);
        provide("updateChild", updateChild);
        provide("hightLight", hightLight);
        provide("updateDefaultValue", updateDefaultValue);
        return {
            settings,
            update,
            device,
            clearn,

            preview,
            generate,
            execDownload,
            showCode,
            preViewCode, ClipboardWrite
        };
    },
});
</script>