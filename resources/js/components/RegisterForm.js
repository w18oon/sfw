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

const RegisterForm = (props) => {

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
        is_bankrupt: 'ไม่เป็น',
        is_incompetent_person: 'ไม่ใช่',
        is_permanent_disability: 'ไม่ใช่',
        is_quasi_incompetent_person: 'ไม่ใช่',
        marital_status: 'โสด',
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
        // axios.get('/api/postcodes').then(res => {
        //     setPostcodes(res.data);
        //     setProvinces([...new Set(res.data.map(postcode => postcode.province))].sort());
        // }).catch(error => {
        //     console.log(error)
        // });
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
        if (event.target.value == 'บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน' || event.target.value == 'บ้านเช่า') {
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

        if (member.title == 'อื่นๆ' && member.other_title == '') {
            setErrors(prevState => {
                return [...prevState, 'other_title']
            });
        }

        if (numberOfErrors > 0) {
            swal('เกิดข้อผิดพลาด', 'กรุณากรอกข้อมูลให้ครบถ้วน', 'error');
            return;
        }

        swal({
            icon: 'info',
            text: 'ระบบกำลังบันทึกข้อมูล',
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
                        swal('เกิดข้อผิดพลาด', errMsg.toString(), 'error');
                    } else {
                        swal({
                            icon: 'success',
                            text: 'ระบบบันทึกข้อมูลเรียบร้อย',
                            closeOnEsc: false,
                            closeOnClickOutside: false,
                            button: {
                                text: "ดาวน์โหลดเอกสาร",
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
                        text: 'ระบบบันทึกข้อมูลเรียบร้อย',
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
            <Modal backdrop="static" keyboard={false} show={show} size="lg" onHide={handleClose}>
                <Modal.Header style={{ display: "flex", justifyContent: "center", alignItems: "center", }}>
                    <Modal.Title>เจตนารมณ์และพันธกรณีระหว่างกองทุนอิสระฯ กับสมาชิก</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <ul>
                        <li>ข้อ 1 หลังจากที่กองทุนอิสระฯ ดำเนินการแก้ปัญหาหนี้สินให้กับสมาชิกกองทุนอิสระฯ เป็นที่เรียบร้อยแล้ว และสมาชิกกองทุนอิสระฯ ที่ส่งเงินฝากสัจจะออมทรัพย์ตามสัญญาครบ 10 ปี ในส่วนของเงินฝากสัจจะออมทรัพย์ และทรัพย์สินค้ำประกันทั้งหมด กองทุนอิสระฯจะส่งคืนให้กับทายาทหรือบุคคลในครอบครัวของสมาชิกกองทุนอิสระฯที่ได้ระบุชื่อไว้ในใบสมัครและสัญญาฉบับนี้วัตถุประสงค์เพื่อเป็นการสร้างเครดิตให้แก่ครอบครัวต่อไป</li>
                        <li>ข้อ 2 เมื่อสมาชิกส่งเงินฝากสัจจะออมทรัพย์สม่ำเสมอเป็นเวลา 6 เดือน ตามใบสมัครและตามสัญญาฉบับนี้ จะได้รับเงินฌาปนกิจสงเคราะห์แก่สมาชิกกองทุนอิสระฯ  ผู้เสียชีวิตเป็นจำนวนเงิน 50,000 บาท ตามที่สมาชิกกองทุนอิสระฯ ระบุผู้รับผลประโยชน์ไว้ ดังนั้นก่อนที่สมาชิกกองทุนอิสระฯ จะลงนามในใบสมัครต้องระบุผู้รับผลประโยชน์ให้ชัดเจน แต่หากผู้รับผลประโยชน์เสียชีวิตก่อนสมาชิกกองทุนอิสระฯ ตามสัญญานี้ ก็ให้เงินจำนวนดังกล่าวตกแก่ทายาทผู้มีสิทธิรับมรดก โดยเงินจำนวนดังกล่าวนี้ให้ถือเสมือนทรัพย์มรดก</li>
                        <li>ข้อ 3 กรณีสมาชิกกองทุนอิสระฯ เสียชีวิตก่อนส่งใช้เงินฝากสัจจะออมทรัพย์ครบ 10 ปี ใบสมัครและสัญญาหรือพันธะต่างๆ ที่มีต่อกองทุนอิสระฯ จะสิ้นสุดลงทันที ผู้รับผลประโยชน์ตามใบสมัครและสัญญาฉบับนี้จะได้รับเงินฌาปนกิจจำนวน 50,000 บาท และทายาทผู้มีสิทธิรับมรดกของสมาชิกกองทุนอิสระฯ ที่เสียชีวิต สามารถเข้าร่วมเป็นสมาชิกกองทุนอิสระฯ ได้โดยอัตโนมัติ เว้นแต่ทายาทผู้มีสิทธิรับมรดกของสมาชิกกองทุนอิสระฯ จะมีแสดงเจตนาเป็นอย่างอื่น</li>
                        <li>ข้อ 4 ในระหว่างสัญญาการร่วมโครงการช่วยเหลือแก้ปัญหาหนี้สินแบบปลอดดอกเบี้ย สมาชิกจะต้องให้ความร่วมมือสนับสนุนโครงการต่างๆ ทุกโครงการที่กองทุนอิสระฯ ดำเนินการโดยไม่มีเงื่อนไข เว้นแต่ประธานกองทุนอิสระฯ จะให้เลือกตามแต่ดุลพินิจของประธานกองทุนอิสระฯ</li>
                        <li>ข้อ 5 ในระหว่างที่สมาชิกกองทุนอิสระฯ ได้ให้สัญญาการเข้าร่วมโครงการช่วยเหลือแก้ปัญหาหนี้สินแบบปลอดดอกเบี้ย ยังไม่สิ้นสุด ห้ามมิให้สมาชิกกองทุนอิสระฯ กระทำการใดๆ อันเป็นการสร้างภาระหนี้สินใหม่โดยเด็ดขาด ซึ่งหากสมาชิกกองทุนอิสระฯมีความจำเป็นเกี่ยวกับภาระทางการเงิน สามารถแจ้งความจำนงมายังกองทุนอิสระฯ ทราบ</li>
                        <li>ข้อ 6 หากสมาชิกไม่สามารถปฏิบัติตามเงื่อนไขในใบสมัครหรือตามสัญญาฉบับนี้ ให้ถือว่าสมาชิกกองทุนอิสระฯ ผิดสัญญา และให้สมาชิกกองทุนอิสระฯ พ้นจากสถานภาพการเป็นสมาชิกกองทุนอิสระฯ ทันที  และหรือสัญญาสิ้นสุดทันทีโดยไม่ต้องแจ้งหรือบอกเลิกสัญญาก่อน และสมาชิกกองทุนอิสระฯ จะต้องคืนเงินตามจำนวนที่กองทุนอิสระฯ ได้ดำเนินการซื้อหนี้ไว้ตามจำนวนมูลหนี้พร้อมดอกเบี้ย  ในอัตราดอกเบี้ยร้อยละ 7.5 ต่อปี ของเงินต้นดังกล่าวนับแต่วันที่กองทุนอิสระฯ ได้ซื้อหนี้ตามที่สมาชิกกองทุนอิสระฯ ได้แจ้งไว้ตั้งแต่ต้น</li>
                    </ul>
                    <p>โดยสมาชิกกองทุนอิสระฯ ดังกล่าวนี้  ตกลงและยินยอมรับผิดชอบในความเสียหายที่เกิดขึ้นโดยปราศจาคเงื่อนไขใด ๆ ทั้งสิ้น และสมาชิกกองทุนอิสระฯ ตกลงที่จะไม่ดำเนินคดีกับกองทุนอิสระฯ ตลอนจนผู้ดำเนินการแทนกองทุนอิสระฯ ทั้งทางแพ่ง อาญา หรือตามกฎหมายอื่น ๆ และหรือไม่ติดใจเรียกร้อง ในทางแพ่ง  อาญา หรือตามกฎหมายอื่น ใดๆ ทั้งสิ้น</p>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="danger" onClick={() => { window.location.href = '/' }}>ยกเลิก</Button>
                    <Button variant="success" onClick={handleClose}>ยืนยัน</Button>
                </Modal.Footer>
            </Modal>
            <h4 className="mb-3">ข้อมูลส่วนตัว</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label>จังหวัดสังกัดสมาชิก <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('receipt_province')? 'is-invalid': ''}`}
                        name="receipt_province" 
                        value={member.receipt_province || ''} 
                        onChange={handleInputChange}>
                        <option>เลือก</option>
                        {provinces.map(province => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="title">คำนำหน้า <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('title')? 'is-invalid': ''}`}
                        id="title" 
                        name="title" 
                        value={member.title || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'other_title')}>
                        <option>เลือก</option>
                        {['นาย', 'นาง', 'นางสาว', 'อื่นๆ'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
                <div className="form-group col-2">
                    <label>อื่นๆ (โปรดระบุ)</label>
                    <input type="text" 
                        className={`form-control ${errors.includes('other_title')? 'is-invalid': ''}`} 
                        name="other_title" 
                        value={member.other_title || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.other_title}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
                <div className="form-group col-4">
                    <label htmlFor="firstname">ชื่อ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('firstname')? 'is-invalid': ''}`} 
                        name="firstname" 
                        value={member.firstname || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
                <div className="form-group col-4">
                    <label htmlFor="lastname">นามสกุล <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('lastname')? 'is-invalid': ''}`} 
                        name="lastname" 
                        value={member.lastname || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="id_card_no">บัตรประจำตัวประชาชนเลขที่ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('id_card_no')? 'is-invalid': ''}`} 
                        id="id_card_no"
                        name="id_card_no" 
                        value={member.id_card_no} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ถูกต้องและครบถ้วน</div> */}
                </div>
                <div className="form-group col-3">
                    <label htmlFor="emp_card_no">บัตรข้าราชการ/บัตรพนักงานรัฐวิสาหกิจ</label>
                    <input type="text" 
                        className="form-control" 
                        id="emp_card_no"
                        name="emp_card_no" 
                        value={member.emp_card_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="exp_date">วันหมดอายุ <span className="text-danger">*</span></label>
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
                    <label htmlFor="age">อายุ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('age')? 'is-invalid': ''}`} 
                        id="age"
                        name="age" 
                        value={member.age || ''} 
                        min="0"
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
                <div className="form-group col-1">
                    <label htmlFor="nationality">สัญชาติ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('nationality')? 'is-invalid': ''}`}  
                        id="nationality" 
                        name="nationality" 
                        value={member.nationality || ''} 
                        onChange={handleInputChange}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
                <div className="form-group col-2">
                    <label htmlFor="mobile">โทรศัพท์ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('mobile')? 'is-invalid': ''}`}   
                        id="mobile"
                        name="mobile" 
                        value={member.mobile || ''} 
                        maxLength="10"
                        onChange={handleInputNumberChange}/>
                    {/* <div className="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน</div> */}
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label>เป็นบุคคลล้มละลายหรือไม่ <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input type="radio" 
                                className="form-check-input" 
                                id="is_bankrupt_1" 
                                name="is_bankrupt" 
                                value="เป็น" 
                                onChange={handleInputChange}
                                checked={member.is_bankrupt == 'เป็น'}/>
                            <label className="form-check-label" htmlFor="is_bankrupt_1">เป็น</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input type="radio" 
                                className="form-check-input" 
                                id="is_bankrupt_2" 
                                name="is_bankrupt" 
                                value="ไม่เป็น" 
                                onChange={handleInputChange}
                                checked={member.is_bankrupt == 'ไม่เป็น' || member.is_bankrupt == ''}/>
                            <label className="form-check-label" htmlFor="is_bankrupt_2">ไม่เป็น</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label>คนไร้ความสามารถ <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_incompetent_person_1" 
                                name="is_incompetent_person" 
                                value="ใช่" 
                                onChange={handleInputChange}
                                checked={member.is_incompetent_person == 'ใช่'}/>
                            <label className="form-check-label" htmlFor="is_incompetent_person_1">ใช่</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_incompetent_person_2" name="is_incompetent_person" value="ไม่ใช่" 
                            onChange={handleInputChange}
                            checked={member.is_incompetent_person == 'ไม่ใช่' || member.is_incompetent_person == ''}/>
                            <label className="form-check-label" htmlFor="is_incompetent_person_2">ไม่ใช่</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="field_1_12">ทุพพลภาพถาวร <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_permanent_disability_1" name="is_permanent_disability" value="ใช่" onChange={handleInputChange}
                            checked={member.is_permanent_disability == 'ใช่'}/>
                            <label className="form-check-label" htmlFor="is_permanent_disability_1">ใช่</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_permanent_disability_2" 
                                name="is_permanent_disability" 
                                value="ไม่ใช่" 
                                onChange={handleInputChange}
                                checked={member.is_permanent_disability == 'ไม่ใช่' || member.is_permanent_disability == ''}/>
                            <label className="form-check-label" htmlFor="is_permanent_disability_2">ไม่ใช่</label>
                        </div>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="field_1_13">คนเสมือนไร้ความสามารถ <span className="text-danger">*</span></label>
                    <div className="form-group">
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" type="radio" id="is_quasi_incompetent_person_1" name="is_quasi_incompetent_person" value="ใช่" 
                                onChange={handleInputChange}
                                checked={member.is_quasi_incompetent_person == 'ใช่'}/>
                            <label className="form-check-label" htmlFor="is_quasi_incompetent_person_1">ใช่</label>
                        </div>
                        <div className="form-check form-check-inline">
                            <input className="form-check-input" 
                                type="radio" 
                                id="is_quasi_incompetent_person_2" 
                                name="is_quasi_incompetent_person" 
                                value="ไม่ใช่" 
                                onChange={handleInputChange}
                                checked={member.is_quasi_incompetent_person == 'ไม่ใช่' || member.is_quasi_incompetent_person == ''}/>
                            <label className="form-check-label" htmlFor="is_quasi_incompetent_person_2">ไม่ใช่</label>
                        </div>
                    </div>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-6">
                    <label>สถานภาพสมรส <span className="text-danger">*</span></label>
                    <div className="form-group">
                        {['โสด', 'หย่า', 'สมรสจดทะเบียน', 'สมรสไม่จดทะเบียน','หม้าย'].map((element, index) => (
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
                    <label htmlFor="number_of_children">จำนวนบุตร</label>
                    <input type="number" 
                        className="form-control" 
                        id="number_of_children" 
                        name="number_of_children" 
                        value={member.number_of_children || ''} 
                        onChange={handleInputChange}
                        min="0"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="number_of_children_study">จำนวนบุตรที่กำลังศึกษาอยู่</label>
                    <input type="number" 
                        className="form-control" 
                        id="number_of_children_study" 
                        name="number_of_children_study" 
                        value={member.number_of_children_study || ''} 
                        onChange={handleInputChange}
                        min="0"/>
                </div>
            </div>
            <h4 className="mb-3">ข้อมูลคู่สมรส</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="title">คำนำหน้า</label>
                    <select className="form-control" 
                        name="spouse_title" 
                        value={member.spouse_title || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'other_spouse_title')}>
                        <option>เลือก</option>
                        {['นาย', 'นาง', 'นางสาว', 'อื่นๆ'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_spouse_title">อื่นๆ (โปรดระบุ)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_spouse_title"
                        name="other_spouse_title" 
                        value={member.other_spouse_title || ''}
                        onChange={handleInputChange}
                        disabled={disabledInput.other_spouse_title}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="spouse_firstname">ชื่อ</label>
                    <input type="text" className="form-control" id="spouse_firstname" name="spouse_firstname" value={member.spouse_firstname || ''} onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="spouse_lastname">นามสกุล</label>
                    <input type="text" className="form-control" id="spouse_lastname" name="spouse_lastname" value={member.spouse_lastname || ''} onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-3">
                    <label htmlFor="spouse_id_card_no">บัตรประจำตัวประชาชนเลขที่</label>
                    <input type="number" 
                        className={`form-control ${errors.includes('spouse_id_card_no')? 'is-invalid': ''}`} 
                        name="spouse_id_card_no" 
                        value={member.spouse_id_card_no || ''} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                </div>
            </div>
            <h4 className="mb-3">ที่อยู่ตามทะเบียนบ้าน</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="house_no">บ้านเลขที่ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('house_no')? 'is-invalid': ''}`} 
                        id="house_no" 
                        name="house_no" 
                        value={member.house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="moo">หมู่ที่</label>
                    <input type="text" 
                        className="form-control" 
                        id="moo" 
                        name="moo" 
                        value={member.moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="soi">ตรอก/ซอย</label>
                    <input type="text" 
                        className="form-control" 
                        id="soi" 
                        name="soi" 
                        value={member.soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="street">ถนน</label>
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
                    <label htmlFor="province">จังหวัด <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('province')? 'is-invalid': ''}`}
                        id="province"
                        name="province" 
                        value={member.province || ''} 
                        onChange={(event) => handleProvinceChange(event, 'member')}>
                        <option>เลือก</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="district">อำเภอ/เขต <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('district')? 'is-invalid': ''}`}
                        id="district" 
                        name="district" 
                        value={member.district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'member', member.province)}>
                        <option>เลือก</option>
                        {districts.member.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="sub_district">ตำบล/แขวง <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('sub_district')? 'is-invalid': ''}`}
                        id="sub_district" 
                        name="sub_district" 
                        value={member.sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'member', member.province, member.district, 'post_code')}>
                        <option>เลือก</option>
                        {subDistricts.member.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="post_code">รหัสไปรษณีย์</label>
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
                    <label htmlFor="tel">โทรศัพท์ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('tel')? 'is-invalid': ''}`}
                        id="tel" 
                        name="tel" 
                        value={member.tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="fax">โทรสาร</label>
                    <input type="text" 
                        className="form-control" 
                        id="fax" 
                        name="fax" 
                        value={member.fax || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="mail">อีเมล</label>
                    <input type="text" 
                        className="form-control" 
                        id="mail" 
                        name="mail" 
                        value={member.mail || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">ที่อยู่จัดส่งเอกสาร</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="ship_house_no">บ้านเลขที่ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('ship_house_no')? 'is-invalid': ''}`} 
                        id="ship_house_no" 
                        name="ship_house_no" 
                        value={member.ship_house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="ship_moo">หมู่ที่ </label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_moo" 
                        name="ship_moo" 
                        value={member.ship_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_soi">ตรอก/ซอย</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_soi" 
                        name="ship_soi" 
                        value={member.ship_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="ship_street">ถนน</label>
                    <input type="text" 
                        className="form-control" 
                        id="ship_street" 
                        name="ship_street" 
                        value={member.ship_street || ''} onChange={handleInputChange}/>
                </div>
            </div>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="ship_province">จังหวัด <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_province')? 'is-invalid': ''}`}
                        id="ship_province"
                        name="ship_province" 
                        value={member.ship_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'ship')}>
                        <option>เลือก</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="ship_district">อำเภอ/เขต <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_district')? 'is-invalid': ''}`} 
                        id="ship_district" 
                        name="ship_district" 
                        value={member.ship_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'ship', member.ship_province)}>
                        <option>เลือก</option>
                        {districts.ship.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="ship_sub_district">ตำบล/แขวง <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('ship_sub_district')? 'is-invalid': ''}`} 
                        id="ship_sub_district" 
                        name="ship_sub_district" 
                        value={member.ship_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'ship', member.ship_province, member.ship_district, 'ship_postcode')}>
                        <option>เลือก</option>
                        {subDistricts.ship.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="ship_postcode">รหัสไปรษณีย์</label>
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
                    <label htmlFor="ship_tel">โทรศัพท์ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('ship_tel')? 'is-invalid': ''}`} 
                        id="ship_tel" 
                        name="ship_tel" 
                        value={member.ship_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="ship_mail">อีเมล</label>
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
                    <label htmlFor="house_type">ที่อยู่อาศัยปัจจุบัน <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('house_type')? 'is-invalid': ''}`} 
                        id="house_type" 
                        name="house_type" 
                        value={member.house_type || ''} 
                        onChange={handleHouseTypeChange}>
                        <option>เลือก</option>
                        {['บ้านตนเองปลอดภาระ', 'บ้านของบิดามารดา', 'บ้านของญาติ', 'บ้านพักสวัสดิการ', 'บ้านตนเองและผ่อนอยู่กับสถาบันการเงิน', 'บ้านเช่า'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="cost_per_month">ผ่อนชำระ/ค่าเช่า (ต่อเดือน)</label>
                    <input type="text" 
                        className="form-control" 
                        id="cost_per_month" 
                        name="cost_per_month" 
                        value={member.cost_per_month || ''} 
                        onChange={handleInputChange} 
                        disabled={disabledCostPerMonth}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="house_year">อาศัยอยู่เป็นเวลา (ปี)</label>
                    <input type="number" 
                        className="form-control" 
                        id="house_year" 
                        name="house_year" 
                        value={member.house_year || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="education_level">ระดับการศึกษาสูงสุด <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('education_level')? 'is-invalid': ''}`} 
                        id="education_level" 
                        name="education_level" 
                        value={member.education_level || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'other_education_level')}>
                        <option>เลือก</option>
                        {['ต่ำกว่ามัธยมศึกษาตอนปลาย', 'มัธยมศึกษาตอนปลาย', 'อนุปริญญา', 'ปวช./ปวส.', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก', 'อื่นๆ'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_education_level">อื่นๆ (โปรดระบุ)</label>
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
                    <label htmlFor="career">สาขาอาชีพ <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('career')? 'is-invalid': ''}`} 
                        id="career" 
                        name="career" 
                        value={member.career || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'other_career')}>
                        <option>เลือก</option>
                        {['ข้าราชการประจำ', 'ข้าราชการบำนาญ', 'ข้าราชการบำเหน็จ', 'พนักงานรัฐวิสาหกิจ', 'นักเรียน/นักศึกษา', 'เกษตรกร', 'ลูกจ้างประจำ', 'ค้าขาย', 'พนักงานเอกชน', 'อื่นๆ'].map((option) => (
                        <option key={option} value={option}>{option}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_career">อื่นๆ (โปรดระบุ)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_career" 
                        name="other_career" 
                        value={member.other_career || ''}
                        onChange={handleInputChange} 
                        disabled={disabledInput.other_career}/>
                </div>
            </div>
            <h4 className="mb-3">รายได้</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="income_type">รายได้ประจำ <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('income_type')? 'is-invalid': ''}`} 
                        id="income_type" 
                        name="income_type" 
                        value={member.income_type || ''} 
                        onChange={handleInputChange}>
                        <option>เลือก</option>
                        <option value="เงินเดือน/เงินบำนาญ/เงินรายได้">เงินเดือน/เงินบำนาญ/เงินรายได้</option>
                        <option value="เงินค่าจ้าง/เงินค่าตอบแทน">เงินค่าจ้าง/เงินค่าตอบแทน</option>
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="income_amount">จำนวน (บาท/เดือน) <span className="text-danger">*</span></label>
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
                    <label htmlFor="other_income_type">รายได้อื่นๆ</label>
                    <select className="form-control" 
                        id="other_income_type" 
                        name="other_income_type" 
                        value={member.other_income_type || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'other_income')}>
                        <option>เลือก</option>
                        <option value="ค่าล่วงเวลา">ค่าล่วงเวลา</option>
                        <option value="ค่าคอมมิชชั่น">ค่าคอมมิชชั่น</option>
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_income">อื่นๆ (โปรดระบุ)</label>
                    <input type="text" 
                        className="form-control" 
                        id="other_income" 
                        name="other_income" 
                        value={member.other_income || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.other_income}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="other_income_amount">จำนวน (บาท/เดือน)</label>
                    <input type="number" 
                        className="form-control" 
                        id="other_income_amount" 
                        name="other_income" 
                        value={member.other_income_name || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="source_other_income">แหล่งที่มา</label>
                    <input type="text" 
                        className="form-control" 
                        id="source_other_income" 
                        name="source_other_income" 
                        value={member.source_other_income || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">ภาระหนี้กับสถาบันการเงิน/บริษัท/หนี้นอกระบบ</h4>
            <h5 className="mb-3">1.หนี้สินในระบบแบบถูกกฏหมาย</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">เป็นหนี้คงเหลือ</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_1" 
                        name="debt_type_1" 
                        value={member.debt_type_1 || 0} 
                        onChange={handleInputChange}
                        readOnly/>
                </div>
                <label className="col-2 col-form-label">บาท</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รายการ</th>
                        <th scope="col">จำนวนเงินที่กู้</th>
                        <th scope="col">จำนวนหนี้คงเหลือ</th>
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
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 1, i)}>ลบรายการนี้</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 1)}>เพิ่มรายการ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">2.หนี้สินนอกระบบแบบถูกกฏหมาย</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">เป็นหนี้คงเหลือ</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_2" 
                        name="debt_type_2" 
                        value={member.debt_type_2 || 0} 
                        onChange={handleInputChange}
                        disabled/>
                </div>
                <label className="col-2 col-form-label">บาท</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รายการ</th>
                        <th scope="col">จำนวนเงินที่กู้</th>
                        <th scope="col">จำนวนหนี้คงเหลือ</th>
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
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 2, i)}>ลบรายการนี้</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 2)}>เพิ่มรายการ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">3.หนี้สินนอกระบบแบบผิดกฏหมาย</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">เป็นหนี้คงเหลือ</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_3" 
                        name="debt_type_3" 
                        value={member.debt_type_3 || 0} 
                        onChange={handleInputChange}
                        disabled/>
                </div>
                <label className="col-2 col-form-label">บาท</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รายการ</th>
                        <th scope="col">จำนวนเงินที่กู้</th>
                        <th scope="col">จำนวนหนี้คงเหลือ</th>
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
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 3, i)}>ลบรายการนี้</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 3)}>เพิ่มรายการ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5 className="mb-3">4.หนี้สินแบบสหกรณ์</h5>
            <div className="form-group row">
                <label htmlFor="staticEmail" className="col-2 col-form-label">เป็นหนี้คงเหลือ</label>
                <div className="col-4">
                    <input type="number" 
                        className="form-control"
                        id="debt_type_4" 
                        name="debt_type_4" 
                        value={member.debt_type_4 || 0} 
                        onChange={handleInputChange}/>
                </div>
                <label className="col-2 col-form-label">บาท</label>
            </div>
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">รายการ</th>
                        <th scope="col">จำนวนเงินที่กู้</th>
                        <th scope="col">จำนวนหนี้คงเหลือ</th>
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
                            <a className="btn btn-link" onClick={e => removeDebtDtl(e, 4, i)}>ลบรายการนี้</a>
                        </td>
                    </tr>
                    ))}
                    <tr>
                        <td colSpan="5">
                            <a className="btn btn-link" onClick={e => addDebtDtl(e, 4)}>เพิ่มรายการ</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h4 className="mb-3">สถานทีทำงาน</h4>
            <div className="form-row">
                <div className="form-group col-4">
                    <label htmlFor="workplace">ชื่อสถานที่ทำงาน</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace" 
                        name="workplace" 
                        value={member.workplace || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="building">อาคาร</label>
                    <input type="text" 
                        className="form-control" 
                        id="building" 
                        name="building" 
                        value={member.building || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-1">
                    <label htmlFor="floor">ชั้น</label>
                    <input type="text" 
                        className="form-control" 
                        id="floor" name="floor" 
                        value={member.floor || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="department">แผนก/ฝ่าย</label>
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
                    <label htmlFor="workplace_no">เลขที่ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('workplace_no')? 'is-invalid': ''}`} 
                        id="workplace_no"
                        name="workplace_no" 
                        value={member.workplace_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_moo">หมู่ที่</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_moo"
                        name="workplace_moo" 
                        value={member.workplace_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="workplace_soi">ตรอก/ซอย</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_soi"
                        name="workplace_soi" 
                        value={member.workplace_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="workplace_street">ถนน</label>
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
                    <label htmlFor="workplace_province">จังหวัด <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_province')? 'is-invalid': ''}`} 
                        id="workplace_province"
                        name="workplace_province" 
                        value={member.workplace_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'workplace')}>
                        <option>เลือก</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="workplace_district">อำเภอ/เขต <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_district')? 'is-invalid': ''}`} 
                        id="workplace_district" 
                        name="workplace_district" 
                        value={member.workplace_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'workplace', member.workplace_province)}>
                        <option>เลือก</option>
                        {districts.workplace.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="workplace_sub_district">ตำบล/แขวง <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('workplace_sub_district')? 'is-invalid': ''}`} 
                        id="workplace_sub_district" 
                        name="workplace_sub_district" 
                        value={member.workplace_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'workplace', member.workplace_province, member.workplace_district, 'workplace_postcode')}>
                        <option>เลือก</option>
                        {subDistricts.workplace.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_postcode">รหัสไปรษณีย์</label>
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
                    <label htmlFor="workplace_tel">โทรศัพท์ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('workplace_tel')? 'is-invalid': ''}`} 
                        id="workplace_tel"
                        name="workplace_tel" 
                        value={member.workplace_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="workplace_fax">โทรสาร</label>
                    <input type="text" 
                        className="form-control" 
                        id="workplace_fax"
                        name="workplace_fax" 
                        value={member.workplace_fax || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="work_exp">อายุงานปัจจุบัน (ปี/เดือน)</label>
                    <input type="text" 
                        className="form-control"
                        id="work_exp"
                        name="work_exp" 
                        value={member.work_exp || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-6">
                    <label htmlFor="job_position">ชื่อตำแหน่งงาน</label>
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
                    <label htmlFor="old_workplace">กรณีที่ผู้มีรายได้ประจำ อายุงานไม่ถึง 6 เดือน โปรดระบุชื่อสถานที่ทำงานเดิม</label>
                    <input type="text" 
                        className="form-control" 
                        id="old_workplace"
                        name="old_workplace" 
                        value={member.old_workplace || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">ผู้รับโอนผลประโยชน์ของข้าพเจ้า</h4>
            <div className="form-row">
                <div className="form-group col-2">
                    <label htmlFor="benef_title">คำนำหน้า <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_title')? 'is-invalid': ''}`}
                        id="benef_title" 
                        name="benef_title" 
                        value={member.benef_title || ''} 
                        onChange={(e) => handleSelectChange(e, 'อื่นๆ', 'benef_other_title')}>
                        <option>เลือก</option>
                        {['นาย', 'นาง', 'นางสาว', 'อื่นๆ'].map((title) => (
                        <option key={title} value={title}>{title}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_other_title">อื่นๆ (โปรดระบุ)</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_other_title"
                        name="benef_other_title" 
                        value={member.benef_other_title || ''} 
                        onChange={handleInputChange}
                        disabled={disabledInput.benef_other_title}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_firstname">ชื่อ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('benef_firstname')? 'is-invalid': ''}`}
                        id="benef_firstname" 
                        name="benef_firstname" 
                        value={member.benef_firstname || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_lastname">นามสกุล <span className="text-danger">*</span></label>
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
                    <label htmlFor="benef_id_card_no">บัตรประจำตัวประชาชนเลขที่ <span className="text-danger">*</span></label>
                    <input type="number" 
                        className={`form-control ${errors.includes('benef_id_card_no')? 'is-invalid': ''}`} 
                        id="benef_id_card_no"
                        name="benef_id_card_no" 
                        value={member.benef_id_card_no || ''} 
                        onChange={handleIdChange}
                        maxLength="13"/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_relationship">มีความสัมพันธ์เป็น</label>
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
                    <label htmlFor="benef_house_no">เลขที่ <span className="text-danger">*</span></label>
                    <input type="text" 
                        className={`form-control ${errors.includes('benef_house_no')? 'is-invalid': ''}`} 
                        id="benef_house_no" 
                        name="benef_house_no" 
                        value={member.benef_house_no || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_moo">หมู่ที่</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_moo" 
                        name="benef_moo" 
                        value={member.benef_moo || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_soi">ตรอก/ซอย</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_soi" 
                        name="benef_soi" 
                        value={member.benef_soi || ''} 
                        onChange={handleInputChange}/>
                </div>
                <div className="form-group col-5">
                    <label htmlFor="benef_street">ถนน</label>
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
                    <label htmlFor="benef_province">จังหวัด <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_province')? 'is-invalid': ''}`} 
                        id="benef_province"
                        name="benef_province" 
                        value={member.benef_province || ''} 
                        onChange={(e) => handleProvinceChange(e, 'benef')}>
                        <option>เลือก</option>
                        {provinces.map((province) => (
                        <option key={province} value={province}>{province}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_district">อำเภอ/เขต <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_district')? 'is-invalid': ''}`} 
                        id="benef_district" 
                        name="benef_district" 
                        value={member.benef_district || ''} 
                        onChange={(e) => handleDistrictChange(e, 'benef', member.benef_province)}>
                        <option>เลือก</option>
                        {districts.benef.map((district) => (
                        <option key={district} value={district}>{district}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-4">
                    <label htmlFor="benef_sub_district">ตำบล/แขวง <span className="text-danger">*</span></label>
                    <select className={`custom-select ${errors.includes('benef_sub_district')? 'is-invalid': ''}`} 
                        id="benef_sub_district" 
                        name="benef_sub_district" 
                        value={member.benef_sub_district || ''} 
                        onChange={(e) => handleSubDistrictChange(e, 'benef', member.benef_province, member.benef_district, 'benef_postcode')}>
                        <option>เลือก</option>
                        {subDistricts.benef.map((subDistrict) => (
                        <option key={subDistrict} value={subDistrict}>{subDistrict}</option>
                        ))}
                    </select>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_postcode">รหัสไปรษณีย์</label>
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
                    <label htmlFor="benef_tel">โทรศัพท์</label>
                    <input type="number" 
                        className="form-control" 
                        id="benef_tel" 
                        name="benef_tel" 
                        value={member.benef_tel || ''} 
                        onChange={handleInputNumberChange}
                        maxLength="10"/>
                </div>
                <div className="form-group col-2">
                    <label htmlFor="benef_fax">โทรสาร</label>
                    <input type="text" 
                        className="form-control" 
                        id="benef_fax" 
                        name="benef_fax" 
                        value={member.benef_fax || ''} 
                        onChange={handleInputChange}/>
                </div>
            </div>
            <h4 className="mb-3">เอกสารประกอบ <button type="button" className="btn btn-link" onClick={addDoc}>เพิ่มเอกสารประกอบ</button></h4>
            {member.docs.map((doc,i) => (
            <div className="form-row" key={i}>
                <div className="form-group col-3">
                    <label htmlFor="benef_title">คำอธิบาย</label>
                    <input type="text" 
                        className="form-control" 
                        name="desc"
                        value={doc.desc}
                        onChange={e => handleDocChange(e, i)}/>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_other_title">ไฟล์แนบ</label>
                    <div className="custom-file">
                        <input type="file" 
                            className="custom-file-input" 
                            id="customFile" 
                            onChange={e => handleInputFileChange(e, i)}/>
                        <label className="custom-file-label" htmlFor="customFile">เลือกไฟล์</label>
                    </div>
                </div>
                <div className="form-group col-3">
                    <label htmlFor="benef_other_title">ชื่อไฟล์</label>
                    <input type="text" 
                        className="form-control-plaintext"
                        value={doc.original_name}
                        readOnly/>
                </div>
                <div className="form-group col-3">
                    <button type="button" className="btn btn-link mt-3" onClick={e => removeDoc(e, i)}>ลบเอกสารประกอบ</button>
                </div>
            </div>
            ))}
            <button type="submit" className="btn btn-primary">บันทึกข้อมูล</button>
        </form>
    );
}

export default RegisterForm;

if (document.getElementById('register-form')) {
    const postcodes = document.getElementById('register-form').getAttribute('data-postcodes');
    const member = document.getElementById('register-form').getAttribute('data-member');
    const updatedBy = document.getElementById('register-form').getAttribute('data-updated-by');
    ReactDOM.render(<RegisterForm postcodes={postcodes} member={member} updatedBy={updatedBy}/>, document.getElementById('register-form'));
}
