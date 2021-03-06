import axios from 'axios';
import swal from 'sweetalert';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { Modal, Button } from 'react-bootstrap';
import DatePicker, { registerLocale, setDefaultLocale } from 'react-datepicker';
import th from 'date-fns/locale/th';
registerLocale('th', th);

import "react-datepicker/dist/react-datepicker.css";
import './form.css';
import { event } from 'jquery';

const MemberForm = (props) => {

    const [show, setShow] = useState(true);
    const handleClose = () => setShow(false);

    const [errors, setErrors] = useState([]);

    const [selectedDate, setSelectedDate] = useState('');

    const requireFields = [
        'receipt_province',
        'title',
        'firstname',
        'lastname',
        'id_card_no',
        'exp_date',
        'age',
        'nationality',
        'mobile',
        'marital_status',
        'house_no',
        'province',
        'district',
        'sub_district',
        'tel',
        'ship_house_no',
        'ship_province',
        'ship_sub_district',
        'ship_district',
        'ship_tel',
        'house_type',
        'education_level', 
        'career',
        'income_type',
        'income_amount',
        'workplace_no',
        'workplace_province',
        'workplace_district',
        'workplace_sub_district',
        'workplace_tel',
        'benef_title',
        'benef_firstname',
        'benef_lastname',
        'benef_id_card_no',
        'benef_house_no',
        'benef_province',
        'benef_sub_district',
        'benef_district',
    ];
    
    const [postcodes, setPostcodes] = useState([]);

    const [provinces, setProvinces] = useState([]);

    const [districts, setDistricts] = useState({
        member: [],
        ship: [],
        bener: [],
        workplace: [],
        benef: [],
    });

    const [subDistricts, setSubDistricts] = useState({
        member: [],
        ship: [],
        bener: [],
        workplace: [],
        benef: [],
    });

    const [disabledCostPerMonth, setDisabledCostPerMonth] = useState(true);

    const [disabledInput, setDisabledInput] = useState({
        other_title: true,
        other_spouse_title: true,
        other_education_level: true,
        other_career: true,
        other_income: true,
        benef_other_title: true,
    });

    const [member, setMember] = useState({
        title: '',
        other_title: '',
        firstname: '',
        lastname: '',
        receipt_province: '',
        id_card_no: '',
        emp_card_no: '',
        exp_date: '',
        age: '',
        nationality: '',
        mobile: '',
        is_bankrupt: '?????????????????????',
        is_incompetent_person: '??????????????????',
        is_permanent_disability: '??????????????????',
        is_quasi_incompetent_person: '??????????????????',
        marital_status: '?????????',
        number_of_children: 0,
        number_of_children_study: 0,
        spouse_title: '',
        other_spouse_title: '',
        spouse_firstname: '',
        spouse_lastname: '',
        spouse_id_card_no: '',
        house_no: '',
        moo: '',
        soi: '',
        street: '',
        sub_district: '',
        district: '',
        province: '',
        post_code: '',
        tel: '',
        fax: '',
        mail: '',
        ship_house_no: '',
        ship_moo: '',
        ship_soi: '',
        ship_street: '',
        ship_sub_district: '',
        ship_district: '',
        ship_province: '',
        ship_postcode: '',
        ship_tel: '',
        ship_mail: '',
        ship_line: '',
        ship_fb: '',
        house_type: '',
        cost_per_month: '',
        house_year: '',
        education_level: '',
        other_education_level: '',
        career: '',
        other_career: '',
        income_type: '',
        income_amount: '',
        other_income_type: '',
        other_income: '',
        other_income_amount: '',
        source_other_income: '',
        debt_type_1: 0,
        debt_type_1_dtl: [{
            desc: '',
            total_amount: 0,
            remaining_amount: 0,
        }],
        debt_type_2: 0,
        debt_type_2_dtl: [{
            desc: '',
            total_amount: 0,
            remaining_amount: 0,
        }],
        debt_type_3: 0,
        debt_type_3_dtl: [{
            desc: '',
            total_amount: 0,
            remaining_amount: 0,
        }],
        debt_type_4: 0,
        debt_type_4_dtl: [{
            desc: '',
            total_amount: 0,
            remaining_amount: 0,
        }],
        workplace: '',
        building: '',
        floor: '',
        department: '',
        workplace_no: '',
        workplace_moo: '',
        workplace_soi: '',
        workplace_street: '',
        workplace_sub_district: '',
        workplace_district: '',
        workplace_province: '',
        workplace_postcode: '',
        workplace_tel: '',
        workplace_fax: '',
        work_exp: '',
        job_position: '',
        old_workplace: '',
        benef_title: '',
        benef_other_title: '',
        benef_firstname: '',
        benef_lastname: '',
        benef_id_card_no: '',
        benef_relationship: '',
        benef_house_no: '',
        benef_moo: '',
        benef_soi: '',
        benef_street: '',
        benef_sub_district: '',
        benef_district: '',
        benef_province: '',
        benef_postcode: '',
        benef_tel: '',
        benef_fax: '',
        docs: [{
            name: '',
            desc: '',
            original_name: '',
        }],
    });

    useEffect(() => {
        let propsPostcodes = '';
        if (props.postcodes) {
            propsPostcodes = JSON.parse(props.postcodes);
            setPostcodes(propsPostcodes);
            setProvinces([...new Set(propsPostcodes.map(postcode => postcode.province))].sort());
        }

        if (props.member) {
            let propsMember = JSON.parse(props.member);
            [1, 2, 3, 4].map(i => {
                if (!propsMember[`debt_type_${i}_dtl`]) {
                    propsMember = {...propsMember, [`debt_type_${i}_dtl`]: [{
                        desc: '',
                        total_amount: 0,
                        remaining_amount: 0,
                    }]};
                }
            });

            if (!propsMember.doc) {
                propsMember = {...propsMember, docs: [{
                    name: '',
                    desc: '',
                    original_name: '',
                }]};
            }

            setMember(propsMember);
            setShow(false);

            ['member', 'ship', 'workplace', 'benef'].map(addr => {
                const prefixName = (addr == 'member')? '': `${addr}_`;
    
                if (propsMember[`${prefixName}province`] != '') {
                    let districtFilter = propsPostcodes.filter(postcode => postcode.province == propsMember[`${prefixName}province`]);
            
                    setDistricts(prevState => {
                        return {
                            ...prevState,
                            [addr]: [...new Set(districtFilter.map(district => district.district))].sort(),
                        }
                    });
            
                    let subDistrictFilter = propsPostcodes.filter(postcode => postcode.province == propsMember[`${prefixName}province`] && postcode.district == propsMember[`${prefixName}district`]);
    
                    setSubDistricts(prevState => {
                        return {
                            ...prevState,
                            [addr]: [...new Set(subDistrictFilter.map(subDistrict => subDistrict.sub_district))].sort(),
                        }
                    });
                }
            });
        }
        if(props.updatedBy) {
            setMember(prevState => {
                return {
                    ...prevState,
                    updated_by: props.updatedBy
                }
            });
        }
    }, []);

    
    const handleInputChange = (event) => {
        setMember({...member, [event.target.name]: event.target.value});

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleInputNumberChange = (event) => {
        const { value, maxLength } = event.target;

        setMember({...member, [event.target.name]: value.slice(0, maxLength)});

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleIdChange = (event) => {
        let id = event.target.value;
        if (id != '') {
            if (id.length == 13 && /^\d+$/.test(id)) {
                const lastDigit = id.charAt(12);
                const sum = id.substring(0,12).split('').reduce((total, value, index) => total + (parseInt(value) * (13 - index)), 0);
                if (lastDigit == (11 - sum % 11) % 10) {
                    setErrors(errors.filter(e => e != event.target.name));
                } else {
                    if (!errors.includes(event.target.name)) {
                        setErrors(prevState => {
                            return [...prevState, event.target.name]
                        });
                    }
                }
            } else {
                if (!errors.includes(event.target.name)) {
                    setErrors(prevState => {
                        return [...prevState, event.target.name]
                    });
                }
            }
        } else {
            if (event.target.name == 'spouse_id_card_no') {
                setErrors(errors.filter(e => e != event.target.name));
            }
        }

        setMember({
            ...member,
            [event.target.name]: event.target.value
        });
    }

    const handleDatePickerChange = (date) => {

        setSelectedDate(date);

        const selectedDate = new Date(date);
        const expDate = `${selectedDate.getDate()}/${selectedDate.getMonth() + 1}/${selectedDate.getFullYear()}`;

        setMember({...member, exp_date: expDate });

        if (date != '') {
            setErrors(errors.filter(e => e != 'exp_date'));
        }
    }

    const handleChangeRaw = (raw) => {
        console.log(`raw => ${raw}`);
    }

    const handleProvinceChange = (event, addrType) => {
        let districtFilter = postcodes.filter(postcode => postcode.province == event.target.value);

        setDistricts({
            ...districts,
            [addrType]: [...new Set(districtFilter.map(district => district.district))].sort(),
        })

        setMember({
            ...member,
            [event.target.name]: event.target.value
        });

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleDistrictChange = (event, addrType, selectedProvince) => {
        let subDistrictFilter = postcodes.filter(postcode => postcode.province == selectedProvince && postcode.district == event.target.value);

        setSubDistricts({
            ...subDistricts, 
            [addrType]: [...new Set(subDistrictFilter.map(subDistrict => subDistrict.sub_district))].sort(),
        });

        setMember({
            ...member,
            [event.target.name]: event.target.value
        });

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleSubDistrictChange = (event, addrType, selectedProvince, selectedDistrict, inputPostcode) => {
        let postcodeFilter = postcodes.filter(postcode => postcode.province == selectedProvince && postcode.district == selectedDistrict && postcode.sub_district == event.target.value)[0];

        setMember({
            ...member,
            [event.target.name]: event.target.value,
            [inputPostcode]: postcodeFilter.postcode
        });

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleHouseTypeChange = (event) => {
        setDisabledCostPerMonth(true);
        if (event.target.value == '????????????????????????????????????????????????????????????????????????????????????????????????????????????' || event.target.value == '????????????????????????') {
            setDisabledCostPerMonth(false);
        }

        setMember({
            ...member,
            [event.target.name]: event.target.value
        });

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const handleSelectChange = (event, otherValue, inputName) => {
        setMember({
            ...member,
            [event.target.name]: event.target.value,
            [inputName]: event.target.value != otherValue? '': member[inputName],
        });

        setDisabledInput({
            ...disabledInput,
            [inputName]: event.target.value == otherValue? false: true
        });

        if (event.target.value != '') {
            setErrors(errors.filter(e => e != event.target.name));
        }
    }

    const addDebtDtl = (event, debtType) => {
        event.preventDefault();
        const newDebtDtl = [...member[`debt_type_${debtType}_dtl`], {
            desc: '',
            total_amount: 0,
            remaining_amount: 0,
        }];

        setMember(prevState => {
            return {
                ...prevState,
                [`debt_type_${debtType}_dtl`]: newDebtDtl
            }
        });
    }

    const removeDebtDtl = (event, debtType, index) => {
        event.preventDefault();
        const newDebtDtl = [...member[`debt_type_${debtType}_dtl`]];
        newDebtDtl.splice(index, 1);

        setMember(prevState => {
            return {
                ...prevState,
                [`debt_type_${debtType}_dtl`]: newDebtDtl
            }
        });

        const remainingAmount = newDebtDtl.reduce((acc, curr) => { return acc + parseFloat(curr.remaining_amount) }, 0);
        setMember(prevState => {
            return {
                ...prevState,
                [`debt_type_${debtType}`]: remainingAmount
            }
        });
    }

    const handleDebtDtlChange = (event, debtType, index) => {
        const newDebtDtl = [...member[`debt_type_${debtType}_dtl`]];
        newDebtDtl[index][event.target.name] = event.target.value;

        setMember(prevState => {
            return {
                ...prevState,
                [`debt_type_${debtType}_dtl`]: newDebtDtl
            }
        });

        if (event.target.name === 'remaining_amount') {
            const remainingAmount = newDebtDtl.reduce((acc, curr) => { return acc + parseFloat(curr.remaining_amount) }, 0);
            setMember(prevState => {
                return {
                    ...prevState,
                    [`debt_type_${debtType}`]: remainingAmount
                }
            });
        }
    }

    const addDoc = () => {
        const newDocs = [...member.docs, {
            name: '',
            desc: '',
            original_name: '',
        }];

        setMember(prevState => {
            return {
                ...prevState,
                docs: newDocs
            }
        });
    }

    const removeDoc = (event, index) => {
        const newDocs = [...member.docs];
        newDocs.splice(index, 1);

        setMember(prevState => {
            return {
                ...prevState,
                docs: newDocs
            }
        });
    }

    const handleDocChange = (event, index) => {
        const newDocs = [...member.docs];
        newDocs[index][event.target.name] = event.target.value;

        setMember(prevState => {
            return {
                ...prevState,
                docs: newDocs
            }
        });
    }

    const handleInputFileChange = (event, index) => {
        const newDocs = [...member.docs];

        const data = new FormData();
        data.append('document', event.target.files[0]);
        axios.post('/api/upload-document', data).then(response => {
            if (response.status == 200) {
                newDocs[index].name = response.data.name;
            }
        }).catch(error => {
            console.log(error)
        });

        newDocs[index].original_name = event.target.files[0].name;
        
        setMember(prevState => {
            return {
                ...prevState,
                docs: newDocs
            }
        });
    }
    
    const handleSubmitForm = (event) => {
        event.preventDefault();

        let numberOfErrors = 0;

        requireFields.map(field => {
            if (!member[field]) {
                numberOfErrors += 1;
                setErrors(prevState => {
                    return [...prevState, field]
                });
            }
        });

        if (member.title == '???????????????' && member.other_title == '') {
            setErrors(prevState => {
                return [...prevState, 'other_title']
            });
        }

        if (numberOfErrors > 0) {
            swal('??????????????????????????????????????????', '???????????????????????????????????????????????????????????????????????????', 'error');
            return;
        }

        swal({
            icon: 'info',
            text: '???????????????????????????????????????????????????????????????',
            button: false,
            closeOnEsc: false,
            closeOnClickOutside: false,
        });

        if (!member.id) {
            axios.post('/api/member', member).then(response => {
                if (response.status == 200) {
                    console.log(response);
                    if (response.data.error) {
                        const errMsg = response.data.error.errorInfo;
                        swal('??????????????????????????????????????????', errMsg.toString(), 'error');
                    } else {
                        swal({
                            icon: 'success',
                            text: '???????????????????????????????????????????????????????????????????????????',
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                            button: {
                                text: "?????????????????????????????????????????????",
                                closeModal: true,
                            },
                        }).then(value => {
                            if (value) {
                                const id = response.data.member_id;
                                window.location.href = `/contract/${id}`;
                            }
                        });
                    }
                }
            }).catch(error => {
                console.log(error)
            });
        } else {
            axios.put(`/api/member/${member.id}`, member).then(res => {
                console.log(res);
                if (res.status == 200) {
                    console.log(res.data);
                    swal({
                        icon: 'success',
                        text: '???????????????????????????????????????????????????????????????????????????',
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                    }).then(value => {
                        if (value) {
                            window.location.href = `/member`;
                        }
                    });;
                }
            }).catch(err => {
                console.log(err)
            });
        }
    }

    return (
        <form onSubmit={handleSubmitForm}>
            <h4 className="mb-3">???????????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label>????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className="form-control"
                        value={member.receipt_province} 
                        onChange={handleInputChange}
                        disabled={disabledInput.other_title}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="title">???????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('title')? 'is-invalid': ''}`}
                        id="title" 
                        name="title" 
                        value={member.title || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'other_title')}>
                        <option>???????????????</option>
                        {['?????????', '?????????', '??????????????????', '???????????????'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-2">
                    <label>??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className={`form-control ${errors.includes('other_title')? 'is-invalid': ''}`} 
                        name="other_title" 
                        value={member.other_title || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.other_title}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-4">
                    <label htmlFor="firstname">???????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('firstname')? 'is-invalid': ''}`} 
                        name="firstname" 
                        value={member.firstname || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-4">
                    <label htmlFor="lastname">????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('lastname')? 'is-invalid': ''}`} 
                        name="lastname" 
                        value={member.lastname || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="id_card_no">??????????????????????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('id_card_no')? 'is-invalid': ''}`} 
                        id="id_card_no"
                        name="id_card_no" 
                        value={member.id_card_no} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                    {/* <div className="invalid-feedback">?????????????????????????????????????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-3">
                    <label htmlFor="emp_card_no">???????????????????????????????????????/??????????????????????????????????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="emp_card_no"
                        name="emp_card_no" 
                        value={member.emp_card_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="exp_date">?????????????????????????????? <span className="text-danger">*</span></label>
                    <DatePicker dateFormat="dd/MM/yyyy" 
                        locale="th" 
                        selected={selectedDate} 
                        onChange={(date) => handleDatePickerChange(date)}
                        minDate={new Date()}
                        peekNextMonth
                        showMonthDropdown
                        showYearDropdown
                        dropdownMode="select"
                        className={`form-control ${errors.includes('exp_date')? 'is-invalid': ''}`}/>
                </div>
                <div className="form-group col-1">
                    <label htmlFor="age">???????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('age')? 'is-invalid': ''}`} 
                        id="age"
                        name="age" 
                        value={member.age || ''} 
                        min="0"
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-1">
                    <label htmlFor="nationality">????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('nationality')? 'is-invalid': ''}`}  
                        id="nationality" 
                        name="nationality" 
                        value={member.nationality || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
                <div className="form-group col-2">
                    <label htmlFor="mobile">???????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('mobile')? 'is-invalid': ''}`}   
                        id="mobile"
                        name="mobile" 
                        value={member.mobile || ''} 
                        maxLength="10"
                        onChange={handleInputNumberChange}/>
                    {/* <div className="invalid-feedback">???????????????????????????????????????????????????????????????????????????</div> */}
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label>???????????????????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input type="radio" 
                                className="form-check-input" 
                                id="is_bankrupt_1" 
                                name="is_bankrupt" 
                                value="????????????" 
                                onChange={handleInputChange}
                                checked={member.is_bankrupt == '????????????'}/>
                            <label className="form-check-label" htmlFor="is_bankrupt_1">????????????</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input type="radio" 
                                className="form-check-input" 
                                id="is_bankrupt_2" 
                                name="is_bankrupt" 
                                value="?????????????????????" 
                                onChange={handleInputChange}
                                checked={member.is_bankrupt == '?????????????????????' || member.is_bankrupt == ''}/>
                            <label className="form-check-label" htmlFor="is_bankrupt_2">?????????????????????</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label>????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_incompetent_person_1" 
                                name="is_incompetent_person" 
                                value="?????????" 
                                onChange={handleInputChange}
                                checked={member.is_incompetent_person == '?????????'}/>
                            <label className="form-check-label" htmlFor="is_incompetent_person_1">?????????</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_incompetent_person_2" name="is_incompetent_person" value="??????????????????" 
                            onChange={handleInputChange}
                            checked={member.is_incompetent_person == '??????????????????' || member.is_incompetent_person == ''}/>
                            <label className="form-check-label" htmlFor="is_incompetent_person_2">??????????????????</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="field_1_12">???????????????????????????????????? <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_permanent_disability_1" name="is_permanent_disability" value="?????????" onChange={handleInputChange}
                            checked={member.is_permanent_disability == '?????????'}/>
                            <label className="form-check-label" htmlFor="is_permanent_disability_1">?????????</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_permanent_disability_2" 
                                name="is_permanent_disability" 
                                value="??????????????????" 
                                onChange={handleInputChange}
                                checked={member.is_permanent_disability == '??????????????????' || member.is_permanent_disability == ''}/>
                            <label className="form-check-label" htmlFor="is_permanent_disability_2">??????????????????</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="field_1_13">??????????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_quasi_incompetent_person_1" name="is_quasi_incompetent_person" value="?????????" 
                                onChange={handleInputChange}
                                checked={member.is_quasi_incompetent_person == '?????????'}/>
                            <label className="form-check-label" htmlFor="is_quasi_incompetent_person_1">?????????</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_quasi_incompetent_person_2" 
                                name="is_quasi_incompetent_person" 
                                value="??????????????????" 
                                onChange={handleInputChange}
                                checked={member.is_quasi_incompetent_person == '??????????????????' || member.is_quasi_incompetent_person == ''}/>
                            <label className="form-check-label" htmlFor="is_quasi_incompetent_person_2">??????????????????</label>
                        </div>
                    </div>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-6">
                    <label>????????????????????????????????? <span className="text-danger">*</span></label>
                    <div className="form-group">
                        {['?????????', '????????????', '???????????????????????????????????????', '????????????????????????????????????????????????','???????????????'].map((element, index) => (
                        <div className="form-check form-check-inline" key={index}>
                            <input className="form-check-input" 
                                type="radio" 
                                id={`marital_status_${index}`}
                                name="marital_status" 
                                value={element} 
                                onChange={handleInputChange}
                                checked={member.marital_status == element}/>
                            <label className="form-check-label" htmlFor={`marital_status_${index}`}>{element}</label>
                        </div>
                        ))}
                    </div>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="number_of_children">???????????????????????????</label>
                    <input type="number" 
                        className="form-control" 
                        id="number_of_children" 
                        name="number_of_children" 
                        value={member.number_of_children || ''} 
                        onChange={handleInputChange}
                        min="0"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="number_of_children_study">??????????????????????????????????????????????????????????????????????????????</label>
                    <input type="number" 
                        className="form-control" 
                        id="number_of_children_study" 
                        name="number_of_children_study" 
                        value={member.number_of_children_study || ''} 
                        onChange={handleInputChange}
                        min="0"/>
                </div>
            </div>
            <h4 className="mb-3">???????????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="title">????????????????????????</label>
                    <select className="form-control" 
                        name="spouse_title" 
                        value={member.spouse_title || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'other_spouse_title')}>
                        <option>???????????????</option>
                        {['?????????', '?????????', '??????????????????', '???????????????'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_spouse_title">??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_spouse_title"
                        name="other_spouse_title" 
                        value={member.other_spouse_title || ''}
                        onChange={handleInputChange}
                        disabled={disabledInput.other_spouse_title}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="spouse_firstname">????????????</label>
                    <input type="text" className="form-control" id="spouse_firstname" name="spouse_firstname" value={member.spouse_firstname || ''} onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="spouse_lastname">?????????????????????</label>
                    <input type="text" className="form-control" id="spouse_lastname" name="spouse_lastname" value={member.spouse_lastname || ''} onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="spouse_id_card_no">???????????????????????????????????????????????????????????????????????????</label>
                    <input type="number" 
                        className={`form-control ${errors.includes('spouse_id_card_no')? 'is-invalid': ''}`} 
                        name="spouse_id_card_no" 
                        value={member.spouse_id_card_no || ''} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                </div>
            </div>
            <h4 className="mb-3">???????????????????????????????????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="house_no">?????????????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('house_no')? 'is-invalid': ''}`} 
                        id="house_no" 
                        name="house_no" 
                        value={member.house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="moo">?????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="moo" 
                        name="moo" 
                        value={member.moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="soi">????????????/?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="soi" 
                        name="soi" 
                        value={member.soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="street">?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="street" 
                        name="street" 
                        value={member.street || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="province">????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('province')? 'is-invalid': ''}`}
                        id="province"
                        name="province" 
                        value={member.province || ''} 
                        onChange={(event) => handleProvinceChange(event, 'member')}>
                        <option>???????????????</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="district">???????????????/????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('district')? 'is-invalid': ''}`}
                        id="district" 
                        name="district" 
                        value={member.district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'member', member.province)}>
                        <option>???????????????</option>
                        {districts.member.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="sub_district">????????????/???????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('sub_district')? 'is-invalid': ''}`}
                        id="sub_district" 
                        name="sub_district" 
                        value={member.sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'member', member.province, member.district, 'post_code')}>
                        <option>???????????????</option>
                        {subDistricts.member.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="post_code">????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control"
                        id="postcode" 
                        name="post_code" 
                        value={member.post_code || ''} 
                        onChange={handleInputChange} disabled/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="tel">???????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('tel')? 'is-invalid': ''}`}
                        id="tel" 
                        name="tel" 
                        value={member.tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="fax">??????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="fax" 
                        name="fax" 
                        value={member.fax || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="mail">???????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="mail" 
                        name="mail" 
                        value={member.mail || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">?????????????????????????????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="ship_house_no">?????????????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('ship_house_no')? 'is-invalid': ''}`} 
                        id="ship_house_no" 
                        name="ship_house_no" 
                        value={member.ship_house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="ship_moo">????????????????????? </label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_moo" 
                        name="ship_moo" 
                        value={member.ship_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_soi">????????????/?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_soi" 
                        name="ship_soi" 
                        value={member.ship_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="ship_street">?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_street" 
                        name="ship_street" 
                        value={member.ship_street || ''} onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="ship_province">????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_province')? 'is-invalid': ''}`}
                        id="ship_province"
                        name="ship_province" 
                        value={member.ship_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'ship')}>
                        <option>???????????????</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="ship_district">???????????????/????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_district')? 'is-invalid': ''}`} 
                        id="ship_district" 
                        name="ship_district" 
                        value={member.ship_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'ship', member.ship_province)}>
                        <option>???????????????</option>
                        {districts.ship.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="ship_sub_district">????????????/???????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_sub_district')? 'is-invalid': ''}`} 
                        id="ship_sub_district" 
                        name="ship_sub_district" 
                        value={member.ship_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'ship', member.ship_province, member.ship_district, 'ship_postcode')}>
                        <option>???????????????</option>
                        {subDistricts.ship.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="ship_postcode">????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control"
                        id="ship_postcode" 
                        name="ship_postcode" 
                        value={member.ship_postcode} 
                        disabled/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="ship_tel">???????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('ship_tel')? 'is-invalid': ''}`} 
                        id="ship_tel" 
                        name="ship_tel" 
                        value={member.ship_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_mail">???????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_mail" 
                        name="ship_mail" 
                        value={member.ship_mail || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_line">ID Line</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_line" 
                        name="ship_line" 
                        value={member.ship_line || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_fb">Facebook</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_fb" 
                        name="ship_fb" 
                        value={member.ship_fb || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="house_type">???????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('house_type')? 'is-invalid': ''}`} 
                        id="house_type" 
                        name="house_type" 
                        value={member.house_type || ''} 
                        onChange={handleHouseTypeChange}>
                        <option>???????????????</option>
                        {['???????????????????????????????????????????????????', '????????????????????????????????????????????????', '?????????????????????????????????', '????????????????????????????????????????????????', '????????????????????????????????????????????????????????????????????????????????????????????????????????????', '????????????????????????'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="cost_per_month">????????????????????????/????????????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="cost_per_month" 
                        name="cost_per_month" 
                        value={member.cost_per_month || ''} 
                        onChange={handleInputChange} 
                        disabled={disabledCostPerMonth}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="house_year">??????????????????????????????????????????????????? (??????)</label>
                    <input type="number" 
                        className="form-control" 
                        id="house_year" 
                        name="house_year" 
                        value={member.house_year || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="education_level">????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('education_level')? 'is-invalid': ''}`} 
                        id="education_level" 
                        name="education_level" 
                        value={member.education_level || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'other_education_level')}>
                        <option>???????????????</option>
                        {['????????????????????????????????????????????????????????????????????????', '???????????????????????????????????????????????????', '???????????????????????????', '?????????./?????????.', '???????????????????????????', '????????????????????????', '???????????????????????????', '???????????????'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_education_level">??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_education_level" 
                        name="other_education_level" 
                        value={member.other_education_level || ''}
                        onChange={handleInputChange} 
                        disabled={disabledInput.other_education_level}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="career">??????????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('career')? 'is-invalid': ''}`} 
                        id="career" 
                        name="career" 
                        value={member.career || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'other_career')}>
                        <option>???????????????</option>
                        {['??????????????????????????????????????????', '??????????????????????????????????????????', '????????????????????????????????????????????????', '??????????????????????????????????????????????????????', '????????????????????????/????????????????????????', '?????????????????????', '????????????????????????????????????', '??????????????????', '????????????????????????????????????', '???????????????'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_career">??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_career" 
                        name="other_career" 
                        value={member.other_career || ''}
                        onChange={handleInputChange} 
                        disabled={disabledInput.other_career}/>
                </div>
            </div>
            <h4 className="mb-3">??????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="income_type">????????????????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('income_type')? 'is-invalid': ''}`} 
                        id="income_type" 
                        name="income_type" 
                        value={member.income_type || ''} 
                        onChange={handleInputChange}>
                        <option>???????????????</option>
                        <option value="???????????????????????????/???????????????????????????/??????????????????????????????">???????????????????????????/???????????????????????????/??????????????????????????????</option>
                        <option value="?????????????????????????????????/???????????????????????????????????????">?????????????????????????????????/???????????????????????????????????????</option>
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="income_amount">??????????????? (?????????/???????????????) <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('income_amount')? 'is-invalid': ''}`}
                        id="income_amount" 
                        name="income_amount" 
                        value={member.income_amount || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="other_income_type">?????????????????????????????????</label>
                    <select className="form-control" 
                        id="other_income_type" 
                        name="other_income_type" 
                        value={member.other_income_type || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'other_income')}>
                        <option>???????????????</option>
                        <option value="?????????????????????????????????">?????????????????????????????????</option>
                        <option value="???????????????????????????????????????">???????????????????????????????????????</option>
                        <option value="???????????????">???????????????</option>
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_income">??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_income" 
                        name="other_income" 
                        value={member.other_income || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.other_income}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_income_amount">??????????????? (?????????/???????????????)</label>
                    <input type="number" 
                        className="form-control" 
                        id="other_income_amount" 
                        name="other_income" 
                        value={member.other_income_name || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="source_other_income">??????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="source_other_income" 
                        name="source_other_income" 
                        value={member.source_other_income || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">????????????????????????????????????????????????????????????????????????/??????????????????/?????????????????????????????????</h4>
            <h5 className="mb-3">1.???????????????????????????????????????????????????????????????????????????</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">?????????????????????????????????????????????</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_1" 
                        name="debt_type_1" 
                        value={member.debt_type_1 || 0} 
                        onChange={handleInputChange}
                        readOnly/>
                </div>
                <label className="col-2 col-form-label">?????????</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">??????????????????</th>
                        <th scope="col">?????????????????????????????????????????????</th>
                        <th scope="col">????????????????????????????????????????????????</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {member.debt_type_1_dtl.map((dtl,i) => (
                    <tr key={i}>
                        <td scope="row">{ i + 1 }</td>
                        <td>
                            <input type="text" 
                                className="form-control" 
                                name="desc"
                                value={dtl.desc}
                                onChange={e => handleDebtDtlChange(e, 1, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="total_amount" 
                                min="0" 
                                value={dtl.total_amount}
                                onChange={e => handleDebtDtlChange(e, 1, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="remaining_amount" 
                                min="0" 
                                value={dtl.remaining_amount}
                                onChange={e => handleDebtDtlChange(e, 1, i)}/>
                        </td>
                        <td>
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 1, i)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 1)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">2.??????????????????????????????????????????????????????????????????????????????</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">?????????????????????????????????????????????</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_2" 
                        name="debt_type_2" 
                        value={member.debt_type_2 || 0} 
                        onChange={handleInputChange}
                        disabled/>
                </div>
                <label className="col-2 col-form-label">?????????</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">??????????????????</th>
                        <th scope="col">?????????????????????????????????????????????</th>
                        <th scope="col">????????????????????????????????????????????????</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {member.debt_type_2_dtl.map((dtl,i) => (
                    <tr key={i}>
                        <td scope="row">{ i + 1 }</td>
                        <td>
                            <input type="text" 
                                className="form-control" 
                                name="desc"
                                value={dtl.desc}
                                onChange={e => handleDebtDtlChange(e, 2, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="total_amount" 
                                min="0" 
                                value={dtl.total_amount}
                                onChange={e => handleDebtDtlChange(e, 2, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="remaining_amount" 
                                min="0" 
                                value={dtl.remaining_amount}
                                onChange={e => handleDebtDtlChange(e, 2, i)}/>
                        </td>
                        <td>
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 2, i)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 2)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">3.??????????????????????????????????????????????????????????????????????????????</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">?????????????????????????????????????????????</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_3" 
                        name="debt_type_3" 
                        value={member.debt_type_3 || 0} 
                        onChange={handleInputChange}
                        disabled/>
                </div>
                <label className="col-2 col-form-label">?????????</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">??????????????????</th>
                        <th scope="col">?????????????????????????????????????????????</th>
                        <th scope="col">????????????????????????????????????????????????</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {member.debt_type_3_dtl.map((dtl,i) => (
                    <tr key={i}>
                        <td scope="row">{ i + 1 }</td>
                        <td>
                            <input type="text" 
                                className="form-control" 
                                name="desc"
                                value={dtl.desc}
                                onChange={e => handleDebtDtlChange(e, 3, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="total_amount" 
                                min="0" 
                                value={dtl.total_amount}
                                onChange={e => handleDebtDtlChange(e, 3, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="remaining_amount" 
                                min="0" 
                                value={dtl.remaining_amount}
                                onChange={e => handleDebtDtlChange(e, 3, i)}/>
                        </td>
                        <td>
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 3, i)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 3)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">4.????????????????????????????????????????????????</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">?????????????????????????????????????????????</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_4" 
                        name="debt_type_4" 
                        value={member.debt_type_4 || 0} 
                        onChange={handleInputChange}/>
                </div>
                <label className="col-2 col-form-label">?????????</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">??????????????????</th>
                        <th scope="col">?????????????????????????????????????????????</th>
                        <th scope="col">????????????????????????????????????????????????</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    {member.debt_type_4_dtl.map((dtl,i) => (
                    <tr key={i}>
                        <td scope="row">{ i + 1 }</td>
                        <td>
                            <input type="text" 
                                className="form-control" 
                                name="desc"
                                value={dtl.desc}
                                onChange={e => handleDebtDtlChange(e, 4, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="total_amount" 
                                min="0" 
                                value={dtl.total_amount}
                                onChange={e => handleDebtDtlChange(e, 4, i)}/>
                        </td>
                        <td>
                            <input type="number" 
                                className="form-control" 
                                name="remaining_amount" 
                                min="0" 
                                value={dtl.remaining_amount}
                                onChange={e => handleDebtDtlChange(e, 4, i)}/>
                        </td>
                        <td>
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 4, i)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 4)}>?????????????????????????????????</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 className="mb-3">?????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-4">
                    <label htmlFor="workplace">????????????????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace" 
                        name="workplace" 
                        value={member.workplace || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="building">???????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="building" 
                        name="building" 
                        value={member.building || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-1">
                    <label htmlFor="floor">????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="floor" name="floor" 
                        value={member.floor || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="department">????????????/????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="department"
                        name="department" 
                        value={member.department || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="workplace_no">?????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('workplace_no')? 'is-invalid': ''}`} 
                        id="workplace_no"
                        name="workplace_no" 
                        value={member.workplace_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_moo">?????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_moo"
                        name="workplace_moo" 
                        value={member.workplace_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="workplace_soi">????????????/?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_soi"
                        name="workplace_soi" 
                        value={member.workplace_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="workplace_street">?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_street"
                        name="workplace_street" 
                        value={member.workplace_street || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="workplace_province">????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_province')? 'is-invalid': ''}`} 
                        id="workplace_province"
                        name="workplace_province" 
                        value={member.workplace_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'workplace')}>
                        <option>???????????????</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="workplace_district">???????????????/????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_district')? 'is-invalid': ''}`} 
                        id="workplace_district" 
                        name="workplace_district" 
                        value={member.workplace_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'workplace', member.workplace_province)}>
                        <option>???????????????</option>
                        {districts.workplace.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="workplace_sub_district">????????????/???????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_sub_district')? 'is-invalid': ''}`} 
                        id="workplace_sub_district" 
                        name="workplace_sub_district" 
                        value={member.workplace_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'workplace', member.workplace_province, member.workplace_district, 'workplace_postcode')}>
                        <option>???????????????</option>
                        {subDistricts.workplace.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_postcode">????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_postcode" 
                        name="workplace_postcode" 
                        value={member.workplace_postcode} 
                        disabled/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="workplace_tel">???????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('workplace_tel')? 'is-invalid': ''}`} 
                        id="workplace_tel"
                        name="workplace_tel" 
                        value={member.workplace_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_fax">??????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_fax"
                        name="workplace_fax" 
                        value={member.workplace_fax || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="work_exp">????????????????????????????????????????????? (??????/???????????????)</label>
                    <input type="text" 
                        className="form-control"
                        id="work_exp"
                        name="work_exp" 
                        value={member.work_exp || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-6">
                    <label htmlFor="job_position">??????????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control"
                        id="job_position"
                        name="job_position" 
                        value={member.job_position || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-12">
                    <label htmlFor="old_workplace">????????????????????????????????????????????????????????????????????? ??????????????????????????????????????? 6 ??????????????? ????????????????????????????????????????????????????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="old_workplace"
                        name="old_workplace" 
                        value={member.old_workplace || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">??????????????????????????????????????????????????????????????????????????????????????????</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="benef_title">???????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_title')? 'is-invalid': ''}`}
                        id="benef_title" 
                        name="benef_title" 
                        value={member.benef_title || ''} 
                        onChange={(e) => handleSelectChange(e, '???????????????', 'benef_other_title')}>
                        <option>???????????????</option>
                        {['?????????', '?????????', '??????????????????', '???????????????'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_other_title">??????????????? (????????????????????????)</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_other_title"
                        name="benef_other_title" 
                        value={member.benef_other_title || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.benef_other_title}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_firstname">???????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('benef_firstname')? 'is-invalid': ''}`}
                        id="benef_firstname" 
                        name="benef_firstname" 
                        value={member.benef_firstname || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_lastname">????????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('benef_lastname')? 'is-invalid': ''}`}
                        id="benef_lastname" 
                        name="benef_lastname" 
                        value={member.benef_lastname || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="benef_id_card_no">??????????????????????????????????????????????????????????????????????????? <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('benef_id_card_no')? 'is-invalid': ''}`} 
                        id="benef_id_card_no"
                        name="benef_id_card_no" 
                        value={member.benef_id_card_no || ''} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_relationship">??????????????????????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_relationship" 
                        name="benef_relationship" 
                        value={member.benef_relationship || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="benef_house_no">?????????????????? <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('benef_house_no')? 'is-invalid': ''}`} 
                        id="benef_house_no" 
                        name="benef_house_no" 
                        value={member.benef_house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_moo">?????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_moo" 
                        name="benef_moo" 
                        value={member.benef_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_soi">????????????/?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_soi" 
                        name="benef_soi" 
                        value={member.benef_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="benef_street">?????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_street" 
                        name="benef_street" 
                        value={member.benef_street || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="benef_province">????????????????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_province')? 'is-invalid': ''}`} 
                        id="benef_province"
                        name="benef_province" 
                        value={member.benef_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'benef')}>
                        <option>???????????????</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_district">???????????????/????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_district')? 'is-invalid': ''}`} 
                        id="benef_district" 
                        name="benef_district" 
                        value={member.benef_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'benef', member.benef_province)}>
                        <option>???????????????</option>
                        {districts.benef.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_sub_district">????????????/???????????? <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_sub_district')? 'is-invalid': ''}`} 
                        id="benef_sub_district" 
                        name="benef_sub_district" 
                        value={member.benef_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'benef', member.benef_province, member.benef_district, 'benef_postcode')}>
                        <option>???????????????</option>
                        {subDistricts.benef.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_postcode">????????????????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_postcode" 
                        name="benef_postcode" 
                        value={member.benef_postcode} 
                        disabled/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="benef_tel">????????????????????????</label>
                    <input type="number" 
                        className="form-control" 
                        id="benef_tel" 
                        name="benef_tel" 
                        value={member.benef_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_fax">??????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_fax" 
                        name="benef_fax" 
                        value={member.benef_fax || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">???????????????????????????????????? <button type="button" className="btn btn-link" onClick={addDoc}>???????????????????????????????????????????????????</button></h4>
            {member.docs.map((doc,i) => (
            <div className="form-row" key={i}>
                <div className="form-group col-3">
                    <label htmlFor="benef_title">????????????????????????</label>
                    <input type="text" 
                        className="form-control" 
                        name="desc"
                        value={doc.desc}
                        onChange={e => handleDocChange(e, i)}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_other_title">?????????????????????</label>
                    <div className="custom-file">
                        <input type="file" 
                            className="custom-file-input" 
                            id="customFile" 
                            onChange={e => handleInputFileChange(e, i)}/>
                        <label className="custom-file-label" htmlFor="customFile">???????????????????????????</label>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_other_title">????????????????????????</label>
                    <input type="text" 
                        className="form-control-plaintext"
                        value={doc.original_name}
                        readOnly/>
                </div>
                <div className="form-group col-3">
                    <button type="button" className="btn btn-link mt-3" onClick={e => removeDoc(e, i)}>??????????????????????????????????????????</button>
                </div>
            </div>
            ))}
        </form>
    );
}

export default MemberForm;

if (document.getElementById('member-form')) {
    const member = document.getElementById('member-form').getAttribute('data-member');
    ReactDOM.render(<MemberForm member={member}/>, document.getElementById('member-form'));
}
