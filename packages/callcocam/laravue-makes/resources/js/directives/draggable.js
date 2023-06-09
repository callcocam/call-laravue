// Default SortableJS
import Sortable from 'sortablejs';
import { useApi } from "@/api/useAPI";
import { map } from 'lodash';

export default (el, binding) => {
    const { value, instance } = binding;
    const { options, endpoint } = value
    var sortable = Sortable.create(el, options);
};
